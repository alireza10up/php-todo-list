<?php

namespace Hekmatinasser\Jalali\Traits;

use DateTime;
use DateTimeZone;
use Exception;
use Hekmatinasser\Jalali\Exceptions\InvalidDatetimeException;
use Hekmatinasser\Jalali\Exceptions\UnknownTimezoneException;
use Hekmatinasser\Jalali\Jalali;

trait Creator
{
    /**
     * create object of Jalali
     *
     * @param Jalali|DateTime|string|int|null $datetime
     * @param DateTimeZone|string|null $timezone
     */
    public function __construct($datetime = null, $timezone = null)
    {
        $gregorianDatetime = $datetime;
        if (empty($datetime)) {
            $gregorianDatetime = 'now';
        } elseif (is_string($datetime)) {
            $gregorianDatetime = static::faToEnNumbers(static::arToEnNumbers($datetime));
        } elseif ($datetime instanceof DateTime) {
            $gregorianDatetime = "@{$datetime->getTimestamp()}";
        } elseif (is_int($datetime)) {
            $gregorianDatetime = "@$datetime";
        }

        try {
            if ($datetime instanceof DateTime) {
                parent::__construct($gregorianDatetime);
                parent::setTimezone($datetime->getTimezone());
            } else {
                parent::__construct($gregorianDatetime, static::createTimeZone($timezone));
            }
            static::loadMessages();
        } catch (Exception) {
            throw new InvalidDatetimeException($datetime);
        }
    }

    /**
     * Create a Jalali now datetime
     *
     *
     * @param null $timezone
     * @return static
     */
    public static function now($timezone = null): static
    {
        return new static(null, $timezone);
    }

    /**
     * Create a Jalali instance for today.
     *
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function today(DateTimeZone|string $timezone = null): static
    {
        return static::now($timezone)->startDay();
    }

    /**
     * Create a Jalali instance for tomorrow.
     *
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function tomorrow(DateTimeZone|string $timezone = null): static
    {
        return static::now($timezone)->addDay()->startDay();
    }

    /**
     * Create a Jalali instance for yesterday.
     *
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function yesterday(DateTimeZone|string $timezone = null): static
    {
        return static::now($timezone)->subDay()->startDay();
    }

    /**
     * Create a Jalali instance from a DateTime one
     *
     * @param $datetime
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function instance($datetime = null, DateTimeZone|string $timezone = null): static
    {
        return new static($datetime, $timezone);
    }

    /**
     * Get a copy of the instance.
     *
     * @return static
     */
    public function copy(): static
    {
        return clone $this;
    }

    /**
     * Get a copy of the instance.
     *
     * @return static
     */
    public function clone(): static
    {
        return clone $this;
    }

    /**
     * Create a Jalali instance from a DateTime one
     *
     * @param $datetime
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function parse($datetime, DateTimeZone|string $timezone = null): static
    {
        static::loadMessages();
        $names = array_map(function ($value) {
            return " $value ";
        }, array_values(static::$messages['year_months']));
        $values = array_map(function ($value) {
            return "-$value-";
        }, range(1, 12));
        $formatted = self::faToEnNumbers(self::arToEnNumbers($datetime));
        $formatted = str_replace($names, $values, $formatted);
        $formatted = str_replace(array_values(static::$messages['year_months']), range(1, 12), $formatted);

        $parse = date_parse($formatted);
        if ($parse['error_count'] > 0) {
            throw new InvalidDatetimeException($datetime);
        }

        return static::createJalali($parse['year'], $parse['month'], $parse['day'], $parse['hour'], $parse['minute'], $parse['second'], $timezone);
    }

    /**
     * Create a Jalali instance from a DateTime one
     *
     * @param string $format
     * @param string $datetime
     * @param bool|null $timezone
     * @return static
     */
    public static function parseFormat(string $format, string $datetime, bool $timezone = null): static
    {
        static::loadMessages();
        $formatted = self::faToEnNumbers(self::arToEnNumbers($datetime));
        $formatted = str_replace(array_values(static::$messages['year_months']), range(1, 12), $formatted);

        $parse = date_parse_from_format($format, $formatted);
        if ($parse['error_count'] > 0) {
            throw new InvalidDatetimeException($datetime);
        }

        return static::createJalali($parse['year'], $parse['month'], $parse['day'], $parse['hour'], $parse['minute'], $parse['second'], $timezone);
    }

    /**
     * Create a new Jalali instance from a specific date and time gregorain.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function create(int $year, int $month, int $day, int $hour, int $minute, int $second, DateTimeZone|string $timezone = null): static
    {
        return static::createGregorian($year, $month, $day, $hour, $minute, $second, $timezone);
    }

    /**
     * Create a Jalali from just a date gregorian.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function createDate(int $year, int $month, int $day, DateTimeZone|string $timezone = null): static
    {
        list($hour, $minute, $second) = explode('-', (new DateTime())->format('G-i-s'));

        return static::createGregorian($year, $month, $day, $hour, $minute, $second, $timezone);
    }

    /**
     * Create a Jalali instance from just a time gregorian.
     *
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function createTime(int $hour, int $minute, int $second, DateTimeZone|string $timezone = null): static
    {
        list($year, $month, $day) = explode('-', (new DateTime())->format('Y-n-j'));

        return static::createGregorian($year, $month, $day, $hour, $minute, $second, $timezone);
    }

    /**
     * Create a Jalali instance from a timestamp.
     *
     * @param int $timestamp
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function createTimestamp(int $timestamp, DateTimeZone|string $timezone = null): static
    {
        return new static($timestamp, $timezone);
    }

    /**
     * @param null $timezone
     * @return DateTimeZone|string|null
     */
    protected static function createTimeZone($timezone = null): DateTimeZone|string|null
    {
        if ($timezone === null) {
            return new DateTimeZone(date_default_timezone_get());
        } elseif ($timezone instanceof DateTimeZone) {
            return $timezone;
        } elseif ($dataTimeZone = @timezone_open((string) $timezone)) {
            return $dataTimeZone;
        }

        throw new UnknownTimezoneException((string) $timezone);
    }

    /**
     * Create a new Jalali instance from a specific date and time gregorain.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function createGregorian(int $year, int $month, int $day, int $hour, int $minute, int $second, DateTimeZone|string $timezone = null): static
    {
        if (! checkdate($month, $day, $year) || ! static::isValidTime($hour, $minute, $second)) {
            throw new InvalidDatetimeException("$year-$month-$day $hour:$minute:$second");
        }

        return new static(sprintf('%s-%s-%s %s:%s:%s', $year, $month, $day, $hour, $minute, $second), $timezone);
    }

    /**
     * Create a Jalali from just a date gregorian.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function createGregorianDate(int $year, int $month, int $day, DateTimeZone|string $timezone = null): static
    {
        list($hour, $minute, $second) = explode('-', (new DateTime())->format('G-i-s'));

        return static::createGregorian($year, $month, $day, $hour, $minute, $second, $timezone);
    }

    /**
     * Create a Jalali instance from just a time gregorian.
     *
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function createGregorianTime(int $hour, int $minute, int $second, DateTimeZone|string $timezone = null): static
    {
        list($year, $month, $day) = explode('-', (new DateTime())->format('Y-n-j'));

        return static::createGregorian($year, $month, $day, $hour, $minute, $second, $timezone);
    }

    /**
     * Create a new Jalali instance from a specific date and time.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function createJalali(int $year, int $month, int $day, int $hour, int $minute, int $second, DateTimeZone|string $timezone = null): static
    {
        static::validDateTime($year, $month, $day, $hour, $minute, $second);

        list($year, $month, $day) = static::jalaliToGregorian($year, $month, $day);
        $datetime = sprintf('%04s-%02s-%02s %02s:%02s:%02s', $year, $month, $day, $hour, $minute, $second);

        return new static($datetime, $timezone);
    }

    /**
     * Create a Jalali from just a date.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function createJalaliDate(int $year, int $month, int $day, DateTimeZone|string $timezone = null): static
    {
        list($hour, $minute, $second) = explode('-', (new static())->format('G-i-s'));

        return static::createJalali($year, $month, $day, $hour, $minute, $second, $timezone);
    }

    /**
     * Create a Jalali instance from just a time.
     *
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param DateTimeZone|string|null $timezone
     *
     * @return static
     */
    public static function createJalaliTime(int $hour, int $minute, int $second, DateTimeZone|string $timezone = null): static
    {
        list($year, $month, $day) = explode('-', (new static())->format('Y-n-j'));

        return static::createJalali($year, $month, $day, $hour, $minute, $second, $timezone);
    }
}
