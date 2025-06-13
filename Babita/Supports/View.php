<?php
/**
 * Alias for Core View
 *---------------------------------------------------------------------------------------
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 08, 2016
 *---------------------------------------------------------------------------------------
 */

if (! function_exists('view')) {
    /**
     * Include template file.
     *
     * @param  string $path  path to file from views folder
     * @param  array  $data  array of data
     * @param  array  $error array of errors
     */
    function view($path, $data = false, $error = false)
    {
        View::render($path, $data, $error);
    }
}

if (! function_exists('getView')) {
    /**
     * Get template file.
     *
     * @param  string $path  path to file from views folder
     * @param  array  $data  array of data
     * @param  array  $error array of errors
     */
    function getView($path, $data = false, $error = false) {
        return View::get($path, $data, $error);
    }
}

if (! function_exists('viewModule')) {
    /**
     * Include template file.
     *
     * @param  string  $path  path to file from Modules folder
     * @param  array $data  array of data
     * @param  array $error array of errors
     */
    function viewModule($path, $data = false, $error = false)
    {
        View::renderModule($path, $data, $error);
    }
}

if (! function_exists('viewTemplate')) {
    /**
     * Return absolute path to selected template directory.
     *
     * @param  string  $path  path to file from views folder
     * @param  array   $data  array of data
     * @param  string  $custom path to template folder
     */
    function viewTemplate($path, $data = false, $custom = TEMPLATE)
    {
        View::renderTemplate($path, $data, $custom);
    }
}

if (! function_exists('addHeader')) {
    /**
     * Add HTTP header to headers array.
     *
     * @param  string  $header HTTP header text
     */
    function addHeader($header)
    {
        View::addHeader($header);
    }
}

if (! function_exists('addHeaders')) {
    /**
     * Add an array with headers to the view.
     *
     * @param array $headers
     */
    function addHeaders(array $headers = array())
    {
        View::addHeaders($headers);
    }
}

if (! function_exists('sendHeaders')) {
    /**
     * Send headers
     */
    function sendHeaders()
    {
        View::sendHeaders();
    }
}
