<?php
/**
 * Alias for URL Helper
 *---------------------------------------------------------------------------------------
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 08, 2016
 *---------------------------------------------------------------------------------------
 */

if (! function_exists('urlBase')) {
    /**
     * Base url
     */
    function urlBase()
    {
       return Url::base();
    }
}

if (! function_exists('urlRedirect')) {
    /**
     * Redirect to chosen url.
     *
     * @param  string  $url      the url to redirect to
     * @param  boolean $fullpath if true use only url in redirect instead of using DIR
     */
    function urlRedirect($url = null, $fullpath = false)
    {
        Url::redirect($url, $fullpath);
    }
}

if (! function_exists('urlTemplatePath')) {
    /**
     * Created the absolute address to the template folder.
     *
     * @param  boolean $custom
     * @return string url to template folder
     */
    function urlTemplatePath($custom = false)
    {
        return Url::templatePath($custom);
    }
}

if (! function_exists('urlRelativeTemplatePath')) {
    /**
     * Created the relative address to the template folder.
     *
     * @param  boolean $custom
     * @return string url to template folder
     */
    function urlRelativeTemplatePath($custom = false)
    {
        return Url::relativeTemplatePath($custom);
    }
}

if (! function_exists('urlAutoLink')) {
    /**
     * Converts plain text urls into HTML links, second argument will be
     * used as the url label <a href=''>$custom</a>.
     *
     *
     * @param  string $text   data containing the text to read
     * @param  string $custom if provided, this is used for the link label
     *
     * @return string         returns the data with links created around urls
     */
    function urlAutoLink($text, $custom = null)
    {
        return Url::autoLink($text, $custom);
    }
}

if (! function_exists('urlSlug')) {
    /**
     * This function converts and url segment to an safe one, for example:
     * `test name @132` will be converted to `test-name--123`
     * Basicly it works by replacing every character that isn't an letter or an number to an dash sign
     * It will also return all letters in lowercase.
     *
     * @param $slug - The url slug to convert
     *
     * @return mixed|string
     */
    function urlSlug($slug)
    {
        return Url::generateSafeSlug($slug);
    }
}

if (! function_exists('urlPrevious')) {
    /**
     * Go to the previous url.
     */
    function urlPrevious()
    {
        Url::previous();
    }
}

if (! function_exists('urlSegments')) {
    /**
     * Get all url parts based on a / seperator.
     *
     * @return array of segments
     */
    function urlSegments()
    {
        return Url::segments();
    }
}

if (! function_exists('urlGetSegment')) {
    /**
     * Get item in array.
     * @param  int $key array index
     *
     * @return string - returns array index
     */
    function urlGetSegment($key)
    {
        return Url::getSegment(Url::segments(), $key);
    }
}

if (! function_exists('urlLastSegment')) {
    /**
     * Get last item in array.
     *
     * @return string - last array segment
     */
    function urlLastSegment()
    {
        return Url::lastSegment(Url::segments());
    }
}

if (! function_exists('urlFirstSegment')) {
    /**
     * Get first item in array
     *
     * @return int - returns first first array index
     */
    function urlFirstSegment()
    {
        return Url::firstSegment(Url::segments());
    }
}
