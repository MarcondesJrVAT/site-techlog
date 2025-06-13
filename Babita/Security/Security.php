<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 *---------------------------------------------------------------------------------------
 * Modified from CakePHP 3.2 - https://github.com/cakephp/cakephp/tree/master/src/Utility
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 08, 2016
 *---------------------------------------------------------------------------------------
 */
namespace Babita\Security;

use Babita\Security\Crypto\Mcrypt;
use Babita\Security\Crypto\OpenSsl;
use InvalidArgumentException;

/**
 * Security Library contains utility methods related to security
 *
 */
class Security
{

    /**
     * The HMAC salt to use for encryption and decryption routines
     *
     * @var string
     */
    protected $key;

    /**
     * The HMAC salt to use for encryption and decryption routines
     *
     * @var string
     */
    protected $hmacSalt;

    /**
     * Default hash method. If `$type` param for `Security::hash()` is not specified
     * this value is used. Defaults to 'sha1'.
     *
     * @var string
     */
    public $hashType;

    /**
     * The crypto implementation to use.
     *
     * @var object
     */
    protected $instance;


    /**
     * Construct class Security for Encrypts/Decrypts data.
     *
     * @param string $key The 256 bit/32 byte key to use as a cipher key.
     * @param string $hmacSalt The salt to use for the HMAC process. Leave null to use Security.salt.
     * @param string $hashType Method to use (sha1/sha256/md5 etc.)
     * @param object $instance The crypto instance to use (mcrypt/openssl/custom).
     */

    public function __construct($key = APP_KEY, $hmacSalt = APP_KEY, $hashType = 'sha1', $engine = 'mcrypt')
    {
        $this->setKey($key);
        $this->setHmacSalt($hmacSalt);
        $this->setHash($hashType);
        $this->engine($engine);
    }

    /**
     * Set the HMAC salt to be used for encryption/decryption
     * routines.
     *
     * @param string $salt The salt to use for encryption routines.
     */
    public function setKey($salt)
    {
        $this->checkKey($salt);
        $this->key = $salt;
    }

    /**
     * Set the HMAC salt to be used for encryption/decryption
     * routines.
     *
     * @param string $hmacSalt The salt to use for encryption routines.
     */
    public function setHmacSalt($hmacSalt)
    {
        $this->checkKey($hmacSalt);
        $this->hmacSalt = $hmacSalt;
    }

    /**
     * Sets the default hash method for the Security object. This affects all objects.
     *
     * @param string $hash Method to use (sha1/sha256/md5 etc.)
     * @return void
     */
    public function setHash($hash)
    {
        $this->hashType = strtolower($hash);
    }

    /**
     * Get the crypto implementation based on the loaded extensions.
     *
     * You can use this method to forcibly decide between mcrypt/openssl/custom implementations.
     *
     * @param object $instance The crypto instance to use.
     * @return object Crypto instance.
     * @throws \InvalidArgumentException When no compatible crypto extension is available.
     */
    public function engine($instance = null)
    {
        if ($instance === null && $this->instance === null) {
            if (extension_loaded('openssl')) {
                $instance = new OpenSsl();
            } elseif (extension_loaded('mcrypt')) {
                $instance = new Mcrypt();
            }
        }
        return $instance;
        // if ($instance) {
        //     $this->instance = $instance;
        // }
        // if (isset($this->instance)) {
        //     return $this->instance;
        // }
        throw new InvalidArgumentException(
            'No compatible crypto engine available. ' .
            'Load either the openssl or mcrypt extensions'
        );
    }

    /**
     * Create a hash from string using given method.
     *
     * @param string $string String to hash
     * @return string Hash
     */
    public function hash($string)
    {
        if (empty($string)) {
            throw new InvalidArgumentException('The data to hash cannot be empty.');
        }

        $type = $this->hashType;
        $salt = $this->key;
        $string .= $salt;

        return hash($type, $string);
    }

    /**
     * Encrypts/Decrypts a text using the given key using rijndael method.
     *
     * @param string $text Encrypted string to decrypt, normal string to encrypt
     * @param string $operation Operation to perform, encrypt or decrypt
     * @throws \InvalidArgumentException When there are errors.
     * @return string Encrypted/Decrypted string
     */
    public function rijndael($text, $operation)
    {
        if (empty($operation) || !in_array($operation, ['encrypt', 'decrypt'])) {
            throw new InvalidArgumentException('You must specify the operation for Security::rijndael(), either encrypt or decrypt');
        }

        $crypto = $this->engine();
        return $crypto->rijndael($text, $this->key, $operation);
    }

    /**
     * Encrypt a value using AES-256.
     *
     * *Caveat* You cannot properly encrypt/decrypt data with trailing null bytes.
     * Any trailing null bytes will be removed on decryption due to how PHP pads messages
     * with nulls prior to encryption.
     *
     * @param string $plain The value to encrypt.
     * @return string Encrypted data.
     * @throws \InvalidArgumentException On invalid data or key.
     */
    public function encrypt($plain)
    {
        if (empty($plain)) {
            throw new InvalidArgumentException('The data to encrypt cannot be empty.');
        }
        // Generate the encryption and hmac key.
        $key = mb_substr(hash('sha256', $this->key . $this->hmacSalt), 0, 32, '8bit');

        $crypto = $this->engine();
        $ciphertext = $crypto->encrypt($plain, $key);
        $hmac = hash_hmac('sha256', $ciphertext, $key);
        return urlencode( base64_encode( $hmac . $ciphertext ) );
    }

    /**
     * Decrypt a value using AES-256.
     *
     * @param string $cipher The ciphertext to decrypt.
     * @return string Decrypted data. Any trailing null bytes will be removed.
     * @throws \InvalidArgumentException On invalid data or key.
     */
    public function decrypt($cipher)
    {
        if (empty($cipher)) {
            throw new InvalidArgumentException('The data to decrypt cannot be empty.');
        }

        $cipher = base64_decode( urldecode( $cipher) );

        // Generate the encryption and hmac key.
        $key = mb_substr(hash('sha256', $this->key . $this->hmacSalt), 0, 32, '8bit');

        // Split out hmac for comparison
        $macSize = 64;
        $hmac = mb_substr($cipher, 0, $macSize, '8bit');
        $cipher = mb_substr($cipher, $macSize, null, '8bit');

        $compareHmac = hash_hmac('sha256', $cipher, $key);
        if (!$this->constantEquals($hmac, $compareHmac)) {
            return false;
        }

        $crypto = $this->engine();
        return $crypto->decrypt($cipher, $key);
    }

    /**
     * A timing attack resistant comparison that prefers native PHP implementations.
     *
     * @param string $hmac The hmac from the ciphertext being decrypted.
     * @param string $compare The comparison hmac.
     * @return bool
     */
    protected function constantEquals($hmac, $compare)
    {
        if (function_exists('hash_equals')) {
            return hash_equals($hmac, $compare);
        }
        $hashLength = mb_strlen($hmac, '8bit');
        $compareLength = mb_strlen($compare, '8bit');
        if ($hashLength !== $compareLength) {
            return false;
        }
        $result = 0;
        for ($i = 0; $i < $hashLength; $i++) {
            $result |= (ord($hmac[$i]) ^ ord($compare[$i]));
        }
        return $result === 0;
    }

    /**
     * Check the encryption key for proper length.
     *
     * @param string $key Key to check.
     * @return void
     * @throws \InvalidArgumentException When key length is not 256 bit/32 bytes
     */
    protected function checkKey($key)
    {
        if (mb_strlen($key, '8bit') < 32) {
            throw new InvalidArgumentException('Invalid key, key must be at least 256 bits (32 bytes) long.');
        }
    }

}
