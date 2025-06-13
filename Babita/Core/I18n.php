<?php
/**
 * I18n - Simple I18n handler.
 *
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 06, 2016
 */

namespace Babita\Core;

use Babita\Core\Error;

/**
 * I18n class.
 */
class I18n
{
    /**
     * Array with pack language.
     * @var pack
     */
    private static $pack;

    /**
     * Load pack language function.
     *
     * @param string $name
     * @param string $code
     */
    public function __construct($name = "messages", $code = LANGUAGE_CODE)
    {
        $file = BABITA.DS.LANGUAGES_PATH.DS."$code".DS."$name.php";

        if (is_readable($file)) {
                $this->pack = include($file);
        } else {
            echo Error::display("Could not load language file '$code/$name.php'");
            die;
        }
    }

    /**
     * Displays the returned translated text.
     *
     * @param type $msgid The translated string.
     * @return string Translated text according to current locale.
     */
    public function _t($msgid)
    {
        if (isset($this->pack[$msgid]) && !empty($this->pack[$msgid])) {
            return $this->pack[$msgid];
        } else {
            return $msgid;
        }
    }

    /**
     * Get lang for views.
     *
     * @param  string $msgid this is "word" value from language file
     * @param  string $name  name of file with language
     * @param  string $code  optional, language code
     *
     * @return string
     */
    public static function show($msgid, $name = "messages", $code = LANGUAGE_CODE)
    {
        $file = BABITA.DS.LANGUAGES_PATH.DS."$code".DS."$name.php";

        if (is_readable($file)) {
            $pack = include($file);
        } else {
            echo Error::display("Could not load language file '$code/$name.php'");
            die;
        }

        if (isset($pack[$msgid]) && !empty($pack[$msgid])) {
            return $pack[$msgid];
        } else {
            return $msgid;
        }
    }
}
