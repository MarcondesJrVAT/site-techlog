<?php
/**
 * Alias for Date Helper
 *---------------------------------------------------------------------------------------
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 07, 2016
 *---------------------------------------------------------------------------------------
 */

if (! function_exists('now')) {
    /**
     * Get the time now
     * @param string $format.
     * @return string time formatted
     */
    function now($format = null)
    {
        return Date::now($format);
    }
}

if (! function_exists('time')) {
    /**
     * Get time
     * @return string time
     */
    function time()
    {
        return Date::time();
    }
}

if (! function_exists('day')) {
    /**
     * Get day
     * @return string time
     */
    function day()
    {
        return Date::day();
    }
}

if (! function_exists('month')) {
    /**
     * Get month
     * @return string month
     */
    function month()
    {
        return Date::month();
    }
}

if (! function_exists('year')) {
    /**
     * Get year
     * @return string year
     */
    function year()
    {
        return Date::year();
    }
}

if (! function_exists('difference')) {
    /**
     * get the difference between 2 dates
     * @param  date $from start date
     * @param  date $to   end date
     * @return string or object, if type is set then a string is returned otherwise an array is returned
     */
    function difference($date_from, $date_to = null)
    {
    	return Date::difference($date_from, $date_to);
    }
}

if (! function_exists('businessDays')) {
    /**
     * Business Days
     *
     * Get number of working days between 2 dates
     *
     * @param  date     $startDate date in the format of Y-m-d
     * @param  date     $endDate date in the format of Y-m-d
     * @param  booleen  $weekendDays returns the number of weekends
     * @return integer  returns the total number of days
     */
    function businessDays($startDate, $endDate, $weekendDays = false)
    {
    	return Date::businessDays($startDate, $endDate, $weekendDays);
    }
}

if (! function_exists('businessDates')) {
    /**
    * get an array of dates between 2 dates (not including weekends)
    *
    * @param  date    $startDate start date
    * @param  date    $endDate end date
    * @param  integer $nonWork day of week(int) where weekend begins - 5 = fri -> sun, 6 = sat -> sun, 7 = sunday
    * @return array   list of dates between $startDate and $endDate
    */
    function businessDates($startDate, $endDate, $nonWork = 6)
    {
    	return Date::businessDates($startDate, $endDate, $nonWork);
    }
}

 if (! function_exists('daysInMonth')) {
    /**
     * Takes a month/year as input and returns the number of days
     * for the given month/year. Takes leap years into consideration.
     * @param int $month
     * @param int $year
     * @return int
     */
    function daysInMonth($month = 0, $year = '') {
    	return Date::daysInMonth($month, $year);
    }
}

if (! function_exists('dateToTime')) {
    /**
     * Extract time of date
     */
    function dateToTime($date_time)
    {
        return Date::dateToTime($date_time);
    }
}

if (! function_exists('addInDate')) {
    /**
     * Add ou subtract day, week, month ou year in date
     */
    function addInDate($amount, $type, $date)
    {
        return Date::addInDate($amount, $type, $date);
    }
}

if (! function_exists('addDaysDate')) {
    /**
     * Add days in date
     */
    function addDaysDate($amount_days, $date = null)
    {
        return Date::addDaysDate($amount_days, $date);
    }
}

if (! function_exists('subDaysDate')) {
    /**
     * Add days in date
     */
    function subDaysDate($amount_days, $date = null)
    {
        return Date::subDaysDate($amount_days, $date);
    }
}

if (! function_exists('addWeeksDate')) {
    /**
     * Add weeks in date
     */
    function addWeeksDate($amount_weeks, $date = null)
    {
        return Date::addWeeksDate($amount_weeks, $date);
    }
}

if (! function_exists('subWeeksDate')) {
    /**
     * Sub weeks in date
     *
     */
    function subWeeksDate($amount_weeks, $date = null)
    {
        return Date::subWeeksDate($amount_weeks, $date);
    }
}

if (! function_exists('addMonthsDate')) {
    /**
     * Add months in date
     */
    function addMonthsDate($amount_months, $date = null)
    {
        return Date::addMonthsDate($amount_months, $date);
    }
}

if (! function_exists('subMonthsDate')) {
    /**
     * Sub months in date
     */
    function subMonthsDate($amount_months, $date = null)
    {
        return Date::subMonthsDate($amount_months, $date);
    }
}

if (! function_exists('addYearsDate')) {
    /**
     * Add years in date
     */
    function addYearsDate($amount_years, $date = null)
    {
        return Date::addYearsDate($amount_years, $date);
    }
}

if (! function_exists('subYearsDate')) {
    /**
     * Sub years in date
     */
    function subYearsDate($amount_years, $date = null)
    {
        return Date::subYearsDate($amount_years, $date);
    }
}

if (! function_exists('timeToSec')) {
    /**
     * Convert time in seconds
     */
    function timeToSec($time)
    {
        return Date::timeToSec($time);
    }
}

if (! function_exists('secToTime')) {
    /**
     * Convert seconds in time
     */
    function secToTime($seconds)
    {
        return Date::secToTime($seconds);
    }
}

if (! function_exists('age')) {
    /**
     * Get age of date
     */
    function age($birth_date)
    {
        return Date::age($birth_date);
    }
}
