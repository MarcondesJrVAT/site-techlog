<?php
/**
 * RainCaptcha PHP Wrapper v1.1.0
 *
 * Documentation: http://raincaptcha.driversworld.us/pages/docs_php_wrapper
 * http://raincaptcha.driversworld.us/
 *---------------------------------------------------------------------------------------
 * @version 0.0.1
 * @date February 06, 2016
 *---------------------------------------------------------------------------------------
 */

namespace Babita\Helpers;

/**
 * RainCaptcha: Anti-spam protection for your website.
 */
class RainCaptcha
{
    /**
     * Constant holding the API url.
     */
    const HOST = 'http://raincaptcha.driversworld.us/api/v1';

    /**
     * Hold the session id.
     *
     * @var string
     */
    private $sessionId;

    /**
     * When class is called sessionId is stored or server settings are used for reference.
     *
     * @param string $sessionId instance id
     */
    public function __construct($sessionId = null)
    {
        if ($sessionId === null) {
            $this->sessionId = md5($_SERVER['SERVER_NAME'] . ':' . $_SERVER['REMOTE_ADDR']);
        } else {
            $this->sessionId = $sessionId;
        }
    }

    /**
     * Generate an image for the captcha.
     *
     * @return image
     */
    public function getImage()
    {
        return self::HOST . '/image/' . $this->sessionId . '?rand' . rand(100000, 999999);
    }

    /**
     * Compare given answer against the generated session.
     *
     * @param  string $answer
     * @return boolean
     */
    public function checkAnswer($answer)
    {
        if (empty($answer)) {
            return false;
        }
        $response = file_get_contents(self::HOST . '/check/' . $this->sessionId. '/' . $answer);
        if ($response === false) {
            return true;
        }
        return $response === 'true';
    }
}
