<?php
/**
 * Alias for Security component
 *---------------------------------------------------------------------------------------
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 08, 2016
 *--------------------------------------------------------------------------------------*
 */

if (! function_exists('encrypt')) {
    /**
     * Encrypt a value using AES-256.
     *
     * *Caveat* You cannot properly encrypt/decrypt data with trailing null bytes.
     * Any trailing null bytes will be removed on decryption due to how PHP pads messages
     * with nulls prior to encryption.ct class Security for Encrypts/Decrypts data.
     *
     * @param string $plain The value to encrypt.
     * @param string $key The 256 bit/32 byte key to use as a cipher key.
     * @param string $hmacSalt The salt to use for the HMAC process. Leave null to use Security.salt.
     * @param string $hashType Method to use (sha1/sha256/md5 etc.)
     * @param object $instance The crypto instance to use (mcrypt/openssl/custom).
     * @return string Encrypted data.
     */

    function encrypt($plain, $key = APP_KEY, $hmacSalt = APP_KEY, $hashType = 'sha1', $engine = 'mcrypt')
    {
        $security = new Babita\Security\Security($key, $hmacSalt, $hashType, $engine);
        return $security->encrypt($plain);
    }
}

if (! function_exists('decrypt')) {
    /**
     * Decrypt a value using AES-256.
     *
     * @param string $cipher The ciphertext to decrypt.
     * @param string $key The 256 bit/32 byte key to use as a cipher key.
     * @param string $hmacSalt The salt to use for the HMAC process. Leave null to use Security.salt.
     * @param string $hashType Method to use (sha1/sha256/md5 etc.)
     * @param object $instance The crypto instance to use (mcrypt/openssl/custom).
     * @return string Encrypted data.
     */

    function decrypt($cipher, $key = APP_KEY, $hmacSalt = APP_KEY, $hashType = 'sha1', $engine = 'mcrypt')
    {
        $security = new Babita\Security\Security($key, $hmacSalt, $hashType, $engine);
        return $security->decrypt($cipher);
    }
}
