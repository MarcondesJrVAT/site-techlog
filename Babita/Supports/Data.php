<?php
/**
 * Alias for Data Helper
 *---------------------------------------------------------------------------------------
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 07, 2016
 *---------------------------------------------------------------------------------------
 */

if (! function_exists('pr')) {
    /**
     * print_r call wrapped in pre tags
     *
     * @param  string or array $data
     */
    function pr($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

if (! function_exists('vd')) {
    /**
     * var_dump call
     *
     * @param  string or array $data
     */
    function vd($data)
    {
        var_dump($data);
    }
}

if (! function_exists('sl')) {
    /**
     * strlen call - count the lengh of the string.
     *
     * @param  string $data
     * @return string return the count
     */
    function sl($data)
    {
        return strlen($data);
    }
}

if (! function_exists('stu')) {
    /**
     * strtoupper - convert string to uppercase.
     *
     * @param  string $data
     * @return string
     */
    function stu($data)
    {
        return strtoupper($data);
    }
}

if (! function_exists('stl')) {
    /**
     * strtolower - convert string to lowercase.
     *
     * @param  string $data
     * @return string
     */
    function stl($data)
    {
        return strtolower($data);
    }
}

if (! function_exists('ucw')) {
    /**
     * ucwords - the first letter of each word to be a capital.
     *
     * @param  string $data
     * @return string
     */
    function ucw($data)
    {
        return ucwords($data);
    }
}

if (! function_exists('createKey')) {
    /**
     * key - this will generate a 32 character key
     * @return string
     */
     function createKey($length = 32)
     {
        $chars = "!@#$%^&*()_+-=ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $key = "";

        for ($i = 0; $i < $length; $i++) {
            $key .= $chars{rand(0, strlen($chars) - 1)};
        }

        return $key;
     }
}
