<?php
/**
 * Date Helper
 *
 *---------------------------------------------------------------------------------------
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 06, 2016
 *---------------------------------------------------------------------------------------
 */

namespace Babita\Helpers;

/**
 * collection of methods for working with dates.
 */
class Date
{

    /**
     * Get the time now
     * @param string $format.
     * @return string time formatted
     */
    public static function now($format = null)
    {
        return (!$format) ? date('Y-m-d H:i:s') : date($format);
    }

    /**
     * Get time
     * @return string time
     */
    public static function time()
    {
        return self::now('H:i:s');
    }

    /**
     * Get day
     * @return string time
     */
    public static function day()
    {
        return self::now('d');
    }

    /**
     * Get month
     * @return string month
     */
    public static function month()
    {
        return self::now('m');
    }

    /**
     * Get year
     * @return string year
     */
    public static function year()
    {
        return self::now('Y');
    }

    /**
     * get the difference between 2 dates
     * @param  date $from start date
     * @param  date $to   end date
     * @return string or array, if type is set then a string is returned otherwise an array is returned
     *
     * Samples
     *
     * DateHour::difference(Y-m-d, Y-m-d)
     * DateHour::difference(Y-m-d)->y
     * DateHour::difference(Y-m-d)->m
     * DateHour::difference(Y-m-d)->d
     * DateHour::difference(Y-m-d)->h
     * DateHour::difference(Y-m-d)->i
     * DateHour::difference(Y-m-d)->s
     * DateHour::difference(Y-m-d)->weekday
     * DateHour::difference(Y-m-d)->days
     * DateHour::difference(Y-m-d)->format('%Y Years, %m Months e %d Days')
     *
     *
     */
    public static function difference($date_from, $date_to = null)
    {
        $date_to = (!$date_to) ? new \DateTime() : new \DateTime( $date_to );

        $date_from = new \DateTime( $date_from );
        $result = $date_from->diff( $date_to );
        $result->months = ($result->y * 12) + $result->m;
        $result->weeks = number_format( ($result->days / 7), 2, '.', '');
        return $result;
    }

    /**
     * Business Days
     *
     * Get number of working days between 2 dates
     *
     * Taken from http://mugurel.sumanariu.ro/php-2/php-how-to-calculate-number-of-work-days-between-2-dates/
     *
     * @param  date     $startDate date in the format of Y-m-d
     * @param  date     $endDate date in the format of Y-m-d
     * @param  booleen  $weekendDays returns the number of weekends
     * @return integer  returns the total number of days
     */
    public static function businessDays($startDate, $endDate, $weekendDays = false)
    {
        $begin = strtotime($startDate);
        $end = strtotime($endDate);

        if ($begin > $end) {
            //startDate is in the future
            return 0;
        } else {
            $numDays = 0;
            $weekends = 0;

            while ($begin <= $end) {
                $numDays++; // no of days in the given interval
                $whatDay = date('N', $begin);

                if ($whatDay > 5) { // 6 and 7 are weekend days
                    $weekends++;
                }
                $begin+=86400; // +1 day
            };

            if ($weekendDays == true) {
                return $weekends;
            }

            $working_days = $numDays - $weekends;
            return $working_days;
        }
    }

    /**
    * get an array of dates between 2 dates (not including weekends)
    *
    * @param  date    $startDate start date
    * @param  date    $endDate end date
    * @param  integer $nonWork day of week(int) where weekend begins - 5 = fri -> sun, 6 = sat -> sun, 7 = sunday
    * @return array   list of dates between $startDate and $endDate
    */
    public static function businessDates($startDate, $endDate, $nonWork = 6)
    {
        $begin    = new \DateTime($startDate);
        $end      = new \DateTime($endDate);
        $holiday  = [];
        $interval = new \DateInterval('P1D');
        $dateRange= new \DatePeriod($begin, $interval, $end);
        foreach ($dateRange as $date) {
            if ($date->format("N") < $nonWork and !in_array($date->format("Y-m-d"), $holiday)) {
                $dates[] = $date->format("Y-m-d");
            }
        }
        return $dates;
    }

    /**
     * Takes a month/year as input and returns the number of days
     * for the given month/year. Takes leap years into consideration.
     * @param int $month
     * @param int $year
     * @return int
     */
    public static function daysInMonth($month = 0, $year = '') {
        if ($month < 1 OR $month > 12) {
            return 0;
        } elseif (!is_numeric($year) OR strlen($year) !== 4) {
            $year = date('Y');
        }
        if (defined('CAL_GREGORIAN')) {
            return cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        if ($year >= 1970) {
            return (int) date('t', mktime(12, 0, 0, $month, 1, $year));
        }
        if ($month == 2) {
            if ($year % 400 === 0 OR ( $year % 4 === 0 && $year % 100 !== 0)) {
                return 29;
            }
        }
        $days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        return $days_in_month[$month - 1];
    }

    /**
     * Extract time of date
     */
    public static function dateToTime($date_time)
    {
        $time = new \DateTime($date_time);
        return $time->format('H:i:s');
    }

    /**
     * Add ou subtract day, week, month ou year in date
     */
    public static function addInDate($amount, $type, $date)
    {
        if(!$date)
            $date = date('Y-m-d');
        return date('Y-m-d', strtotime("$amount $type", strtotime($date)));
    }

    /**
     * Add days in date
     */
    public static function addDaysDate($amount_days, $date = null)
    {
        return static::addInDate("+$amount_days", 'day', $date);
    }

    /**
     * Add days in date
     */
    public static function subDaysDate($amount_days, $date = null)
    {
        return static::addInDate("-$amount_days", 'day', $date);
    }

    /**
     * Add weeks in date
     */
    public static function addWeeksDate($amount_weeks, $date = null)
    {
        return static::addInDate("+$amount_weeks", 'week', $date);
    }

    /**
     * Sub weeks in date
     *
     */
    public static function subWeeksDate($amount_weeks, $date = null)
    {
        return static::addInDate("-$amount_weeks", 'week', $date);
    }

    /**
     * Add months in date
     */
    public static function addMonthsDate($amount_months, $date = null)
    {
        return static::addInDate("+$amount_months", 'month', $date);
    }

    /**
     * Sub months in date
     */
    public static function subMonthsDate($amount_months, $date = null)
    {
        return static::addInDate("-$amount_months", 'month', $date);
    }

    /**
     * Add years in date
     */
    public static function addYearsDate($amount_years, $date = null)
    {
        return static::addInDate("+$amount_years", 'year', $date);
    }

    /**
     * Sub years in date
     */
    public static function subYearsDate($amount_years, $date = null)
    {
        return static::addInDate("-$amount_years", 'year', $date);
    }

    /**
     * Convert time in seconds
     */
    public static function timeToSec($time)
    {
        list($hours, $minutes, $seconds) = explode(":", $time);
        return ($hours * 3600) + ($minutes * 60) + $seconds;
    }

    /**
     * Convert seconds in time
     */
    public static function secToTime($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor($seconds % 3600 / 60);
        $seconds = $seconds % 60;
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }

    /**
     * Get age of date
     */
    public static function age($birth_date)
    {
        return static::difference($birth_date)->y;
    }

    /**
     * Make ago time
     */
    public static function makeAgo($timestamp)
    {
            $difference = time() - $timestamp;
            $periods = ["sec", "min", "hr", "day", "week", "month", "year", "decade"];
            $lengths = ["60","60","24","7","4.35","12","10"];
            for($j = 0; $difference >= $lengths[$j]; $j++)
                $difference /= $lengths[$j];
                $difference = round($difference);
            if($difference != 1) $periods[$j].= "s";
                $text = "$difference $periods[$j] ago";
                return $text;
    }
}
