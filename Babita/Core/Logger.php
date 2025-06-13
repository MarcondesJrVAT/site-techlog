<?php
/**
 * Logger class - Custom errors
 *
 *---------------------------------------------------------------------------------------
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 06, 2016
 *---------------------------------------------------------------------------------------
 */

namespace Babita\Core;

use Babita\Mvc\View;
use Babita\Mailer\Mail;

/**
 * Record and email/display errors or a custom error message.
 */
class Logger
{
    /**
    * Determins if error should be displayed.
    *
    * @var boolean
    */
    private static $printError = true;

    /**
    * Determins if error should be emailed to MAIL_ADMIN defined in config/config.php.
    *
    * @var boolean
    */
    private static $emailError = false;

    /**
    * Clear the errorlog.
    *
    * @var boolean
    */
    private static $clear = false;

    /**
    * Path to error file.
    *
    * @return string
    */
    private static function errorFile()
    {
        return BABITA . "/public/error.html";
    }

    /**
    * In the event of an error show this message.
    */
    public static function customErrorMsg()
    {
        $baseController = new \Controllers\BaseController;
        $data['title'] = 'Ops, ocorreu um erro ao processar a sua solicitação :(';
        $baseController->renderSite('500', $data);
    }

    /**
    * Saved the exception and calls customer error function.
    *
    * @param  exeption $e
    */
    public static function exceptionHandler($e)
    {
        self::newMessage($e);
        self::customErrorMsg();
    }

    /**
    * Saves error message from exception.
    *
    * @param  numeric $number  error number
    * @param  string  $message the error
    * @param  string  $file    file originated from
    * @param  numeric $line    line number
    */
    public static function errorHandler($number, $message, $file, $line)
    {
        $msg = "$message in $file on line $line";

        if (($number !== E_NOTICE) && ($number < 2048)) {
            self::errorMessage($msg);
            self::customErrorMsg();
        }

        return 0;
    }

    /**
    * New exception.
    *
    * @param  Throwable/Exception $exception
    * @param  boolean   $printError show error or not
    * @param  boolean   $clear       clear the errorlog
    * @param  string    $errorFile  file to save to
    */
    public static function newMessage($exception)
    {

        $message = $exception->getMessage();
        $code = $exception->getCode();
        $file = $exception->getFile();
        $line = $exception->getLine();
        $trace = $exception->getTraceAsString();
        $trace = str_replace(DB_USER, '********', $trace);
        $trace = str_replace(DB_PASS, '********', $trace);
        $date = date('Y-m-d H:i:s');

        $logMessage = "<h3>Exception information:</h3>\n
           <p><strong>Date:</strong> {$date}</p>\n
           <p><strong>Message:</strong> {$message}</p>\n
           <p><strong>Code:</strong> {$code}</p>\n
           <p><strong>File:</strong> {$file}</p>\n
           <p><strong>Line:</strong> {$line}</p>\n
           <h3>Stack trace:</h3>\n
           <pre>{$trace}</pre>\n
           <hr />\n";

        if (!is_file(self::errorFile())) {
            file_put_contents(self::errorFile(), '');
        }

        if (self::$clear) {
            $f = fopen(self::errorFile(), "r+");
            if ($f !== false) {
                ftruncate($f, 0);
                fclose($f);
            }
        }

        file_put_contents(self::errorFile(), $logMessage, FILE_APPEND);

        //send email
        self::sendEmail($logMessage);

        if (self::$printError == true) {
            echo $logMessage;
            exit;
        }
    }

    /**
    * Custom error.
    *
    * @param  string  $error       the error
    * @param  boolean $printError display error
    * @param  string  $errorFile  file to save to
    */
    public static function errorMessage($error)
    {
        $date = date('Y-m-d H:i:s');
        $logMessage = "<p>Error on $date - $error</p>";

        if (!is_file(self::errorFile())) {
            file_put_contents(self::errorFile(), '');
        }

        if (self::$clear) {
            $f = fopen(self::errorFile(), "r+");
            if ($f !== false) {
                ftruncate($f, 0);
                fclose($f);
            }
        } else {
            file_put_contents(self::errorFile(), $logMessage, FILE_APPEND);
        }

        /** send email */
        self::sendEmail($logMessage);

        if (self::$printError == true) {
            echo $logMessage;
            exit;
        }
    }

    /**
     * Send Email upon error.
     *
     * @param  string $message holds the error to send
     */
    public static function sendEmail($message)
    {
        if (self::$emailError == true) {
            $mail = new Mail();
            $mail->from(MAIL_ADMIN);
            $mail->destination(MAIL_ADMIN);
            $mail->subject('New error on '.SITETITLE);
            $mail->body($message);
            $mail->mailsend();
        }
    }
}
