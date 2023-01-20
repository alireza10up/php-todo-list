<?php

namespace Hekmatinasser\Jalali\Traits;

use DateTimeZone;
use Hekmatinasser\Jalali\Exceptions\UnknownSetterException;
use InvalidArgumentException;

trait Accessor
{
    /**
     * Get a part of the Jalali object
     *
     * @param string $name
     * @return string|int
     *@throws InvalidArgumentException
     */
    public function __get(string $name)
    {
        static $formats = [
            'year' => 'Y',
            'month' => 'n',
            'day' => 'j',
            'hour' => 'G',
            'minute' => 'i',
            'second' => 's',
            'micro' => 'u',
            'dayOfWeek' => 'w',
            'dayOfYear' => 'z',
            'weekOfYear' => 'W',
            'daysInMonth' => 't',
            'quarter' => 'q',
            'timestamp' => 'U',
        ];

        if (array_key_exists($name, $formats)) {
            return (int) $this->format($formats[$name]);
        } elseif ($name === 'timezone') {
            return $this->getTimezone()->getName();
        }

        throw new InvalidArgumentException(sprintf("Unknown getter '%s'", $name));
    }

    /**
     * Check if an attribute exists on the object
     *
     * @param string $name
     * @return bool
     */
    public function __isset(string $name)
    {
        try {
            $this->__get($name);

            return true;
        } catch (InvalidArgumentException $e) {
            return false;
        }
    }

    /**
     * Set a part of the Jalali object
     *
     * @param string $name
     * @param int|DateTimeZone|string $value
     * @throws InvalidArgumentException
     */
    public function __set(string $name, int|DateTimeZone|string $value)
    {
        if (in_array($name, ['year', 'month', 'day'])) {
            list($year, $month, $day) = explode('-', $this->format('Y-n-j'));
            $$name = $value;
            $this->setDateJalali($year, $month, $day);
        } elseif (in_array($name, ['hour', 'minute', 'second', 'micro'])) {
            list($hour, $minute, $second, $micro) = explode('-', $this->format('G-i-s-u'));
            $$name = $value;
            $this->setTime($hour, $minute, $second, $micro);
        } elseif ($name == 'timestamp') {
            $this->timestamp($value);
        } elseif ($name == 'timezone') {
            $this->timezone(static::createTimeZone($value));
        } else {
            throw new UnknownSetterException($name);
        }
    }

    /**
     * Set the instance's year
     *
     * @param int $value
     * @return static
     */
    public function year(int $value): static
    {
        $this->year = $value;

        return $this;
    }

    /**
     * Set the instance's month
     *
     * @param int $value
     * @return static
     */
    public function month(int $value): static
    {
        $this->month = $value;

        return $this;
    }

    /**
     * Set the instance's day
     *
     * @param int $value
     * @return static
     */
    public function day(int $value): static
    {
        $this->day = $value;

        return $this;
    }

    /**
     * Set the instance's hour
     *
     * @param int $value
     * @return static
     */
    public function hour(int $value): static
    {
        $this->hour = $value;

        return $this;
    }

    /**
     * Set the instance's minute
     *
     * @param int $value
     * @return static
     */
    public function minute(int $value): static
    {
        $this->minute = $value;

        return $this;
    }

    /**
     * Set the instance's second
     *
     * @param int $value
     * @return static
     */
    public function second(int $value): static
    {
        $this->second = $value;

        return $this;
    }

    /**
     * Set the instance's micro
     *
     * @param int $value
     * @return static
     */
    public function micro(int $value): static
    {
        $this->micro = $value;

        return $this;
    }

    /**
     * Set the instance's timestamp
     *
     * @param int $value
     * @return static
     */
    public function timestamp(int $value): static
    {
        $this->setTimestamp($value);

        return $this;
    }

    /**
     * Alias for setTimezone()
     *
     * @param DateTimeZone|string $value
     * @return static
     */
    public function timezone(DateTimeZone|string $value): static
    {
        $this->setTimezone(static::createTimeZone($value));

        return $this;
    }

    /**
     * Set the date and time all together
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param int $micro
     * @return static
     */
    public function setDateTime(int $year, int $month, int $day, int $hour, int $minute, int $second = 0, int $micro = 0): static
    {
        return $this->setDateJalali($year, $month, $day)->setTime($hour, $minute, $second, $micro);
    }

    /**
     * Sets the current date together
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @return static
     */
    public function setDateJalali(int $year, int $month, int $day): static
    {
        list($year, $month, $day) = static::jalaliToGregorian($year, $month, $day);
        $this->setDate($year, $month, $day);

        return $this;
    }

    /**
     * Set the time by time string
     *
     * @param string $time
     * @return static
     * @throws InvalidArgumentException
     */
    public function setTimeString(string $time): static
    {
        $units = preg_split("/[:.]+/", $time);

        $hour = $units[0];
        $minute = $units[1] ?? 0;
        $second = $units[2] ?? 0;
        $micro = $units[3] ?? 0;

        static::validTime($hour, $minute, $second, $micro);
        $this->setTime($hour, $minute, $second, $micro);

        return $this;
    }
}
