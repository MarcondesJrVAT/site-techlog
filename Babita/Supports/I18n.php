<?php
/**
 * Alias for Core I18n
 *---------------------------------------------------------------------------------------
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 07, 2016
 *---------------------------------------------------------------------------------------
 */

if (! function_exists('language')) {
    /**
     * Load pack language function.
     *
     * @param string $name
     * @param string $code
     */
    function language($name = "messages", $code = LANGUAGE_CODE)
    {
        return new Babita\Core\I18n($name, $code);
    }
}


if (! function_exists('_t')) {
    /**
     * Displays the returned translated text.
     *
     * @param type $msgid The translated string.
     * @return string Translated text according to current locale.
     */
    function _t($msgid)
    {
        $i18n = new Babita\Core\I18n();
        return $i18n->_t($msgid);
    }
}
