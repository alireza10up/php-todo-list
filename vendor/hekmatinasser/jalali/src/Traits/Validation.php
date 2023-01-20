<?php

namespace Hekmatinasser\Jalali\Traits;

use Hekmatinasser\Jalali\Exceptions\InvalidUnitException;
use JetBrains\PhpStorm\Pure;

trait Validation
{
    /**
     * check jalali the instance is a leap year
     *
     * @param int $year
     * @return bool
     */
    public static function isLeapYear(int $year): bool
    {
        return in_array(($year % 33), [1, 5, 9, 13, 17, 22, 26, 30]);
    }

    /**
     * validate a jalali date
     *
     * @param int $month
     * @param int $day
     * @param int $year
     * @return bool
     */
    #[Pure]
    public static function isValidDate(int $year, int $month, int $day): bool
    {
        if ($year < 0) {
            return false;
        }
        if ($month < 1 || $month > 12) {
            return false;
        }
        $dayLastMonthJalali = static::isLeapYear($year) && ($month == 12) ? 30 : static::$daysMonthJalali[$month - 1];
        if ($day < 1 || $day > $dayLastMonthJalali) {
            return false;
        }

        return true;
    }

    /**
     * validate a time
     *
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param int $micro
     * @return bool
     */
    public static function isValidTime(int $hour, int $minute, int $second, int $micro = 0): bool
    {
        return $hour >= 0 && $hour <= 23
            && $minute >= 0 && $minute <= 59
            && $second >= 0 && $second <= 59
            && $micro >= 0 && $micro <= 999999;
    }

    /**
     * valid year jalali
     *
     * @param int $value
     * @return bool
     */
    public static function isValidYear(int $value): bool
    {
        return $value < 0;
    }

    /**
     * valid year jalali
     *
     * @param int $value
     */
    public static function validYear(int $value)
    {
        if ($value < 0) {
            throw new InvalidUnitException('year', $value);
        }
    }

    /**
     * valid mount jalali
     *
     * @param int $value
     * @return bool
     */
    public static function isValidMonth(int $value): bool
    {
        return $value < 1 || $value > 12;
    }

    /**
     * valid mount jalali
     *
     * @param int $value
     */
    public static function validMonth(int $value)
    {
        if ($value < 1 || $value > 12) {
            throw new InvalidUnitException('month', $value);
        }
    }

    /**
     * valid day jalali
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @return bool
     */
    public static function isValidDay(int $year, int $month, int $day): bool
    {
        return static::isValidDate($year, $month, $day);
    }

    /**
     * valid day jalali
     *
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public static function validDay(int $year, int $month, int $day)
    {
        $dayLastMonthJalali = (static::isLeapYear($year) && $month == 12) ? 30 : static::$daysMonthJalali[$month - 1];
        if ($day < 1 || $day > $dayLastMonthJalali) {
            throw new InvalidUnitException('day', $day);
        }
    }

    /**
     * valid hour jalali
     *
     * @param int $value
     * @return bool
     */
    public static function isValidHour(int $value): bool
    {
        return $value < 0 || $value > 23;
    }

    /**
     * valid hour jalali
     *
     * @param int $value
     */
    public static function validHour(int $value)
    {
        if ($value < 0 || $value > 23) {
            throw new InvalidUnitException('hour', $value);
        }
    }

    /**
     * valid minute jalali
     *
     * @param int $value
     * @return bool
     */
    public static function isValidMinute(int $value): bool
    {
        return $value < 0 || $value > 59;
    }

    /**
     * valid minute jalali
     *
     * @param int $value
     */
    public static function validMinute(int $value)
    {
        if ($value < 0 || $value > 59) {
            throw new InvalidUnitException('minute', $value);
        }
    }

    /**
     * valid second jalali
     *
     * @param int $value
     * @return bool
     */
    public static function isValidSecond(int $value): bool
    {
        return $value < 0 || $value > 59;
    }

    /**
     * valid second jalali
     *
     * @param int $value
     */
    public static function validSecond(int $value)
    {
        if ($value < 0 || $value > 59) {
            throw new InvalidUnitException('second', $value);
        }
    }

    /**
     * valid micro jalali
     *
     * @param int $value
     * @return bool
     */
    public static function isValidMicro(int $value): bool
    {
        return $value < 0 || $value > 999999;
    }

    /**
     * valid micro jalali
     *
     * @param int $value
     */
    public static function validMicro(int $value)
    {
        if ($value < 0 || $value > 999999) {
            throw new InvalidUnitException('micro', $value);
        }
    }

    /**
     * valid date jalali
     *
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public static function validDate(int $year, int $month, int $day)
    {
        static::validYear($year);
        static::validMonth($month);
        static::validDay($year, $month, $day);
    }

    /**
     * valid time
     *
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param int $micro
     */
    public static function validTime(int $hour, int $minute, int $second, int $micro = 0)
    {
        static::validHour($hour);
        static::validMinute($minute);
        static::validSecond($second);
        if ($micro) {
            static::validMicro($micro);
        }
    }

    /**
     * valid time
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param int $micro
     */
    public static function validDateTime(int $year, int $month, int $day, int $hour, int $minute, int $second, int $micro = 0)
    {
        static::validDate($year, $month, $day);
        static::validTime($hour, $minute, $second, $micro);
    }
}
