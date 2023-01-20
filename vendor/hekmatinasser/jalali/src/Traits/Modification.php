<?php

namespace Hekmatinasser\Jalali\Traits;

trait Modification
{
    /**
     * Add years to the instance. Positive $value travel forward while
     * negative $value travel into the past.
     *
     * @param int $value
     *
     * @return static
     */
    public function addYears(int $value = 1): static
    {
        return $this->year($this->year + $value);
    }

    /**
     * Add a year to the instance
     *
     * @return static
     */
    public function addYear(): static
    {
        return $this->addYears();
    }

    /**
     * Remove years from the instance.
     *
     * @param int $value
     *
     * @return static
     */
    public function subYears(int $value): static
    {
        return $this->addYears(-1 * $value);
    }

    /**
     * Remove a year from the instance
     *
     * @param int $value
     *
     * @return static
     */
    public function subYear(int $value = 1): static
    {
        return $this->subYears($value);
    }

    /**
     * Add months to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param int $value
     *
     * @return static
     */
    public function addMonths(int $value = 1): static
    {
        list($year, $month, $day, $hour, $minute, $second) = explode('-', $this->format('Y-m-d-H-i-s'));
        $month += $value;
        if ($month > 12) {
            $year += (int) ($month / 12);
            $month = $month % 12;
        } elseif ($month < 1) {
            $year += (int) ($month / 12) - 1;
            $month = 12 + ($month % 12);
        }
        if ($month == 0) {
            $year--;
            $month = 12;
        }
        if (($month > 6 && $month < 12 && $day == 31)) {
            $day--;
        } else {
            if ($month == 12 && ($day == 30 || $day == 31)) {
                $day = static::isLeapYear($year) ? 30 : 29;
            }
        }

        return static::createJalali($year, $month, $day, $hour, $minute, $second, $this->getTimeZone());
    }

    /**
     * Add a month to the instance
     *
     * @return static
     */
    public function addMonth(): static
    {
        return $this->addMonths();
    }

    /**
     * Remove a month from the instance
     *
     * @return static
     */
    public function subMonth(): static
    {
        return $this->subMonths();
    }

    /**
     * Remove months from the instance
     *
     * @param int $value
     *
     * @return static
     */
    public function subMonths(int $value = 1): static
    {
        return $this->addMonths(-1 * $value);
    }

    /**
     * Add days to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param int $value
     *
     * @return static
     */
    public function addDays(int $value = 1): static
    {
        return $this->modify("$value day");
    }

    /**
     * Add a day to the instance
     *
     * @return static
     */
    public function addDay(): static
    {
        return $this->addDays();
    }

    /**
     * Remove a day from the instance
     *
     * @return static
     */
    public function subDay(): static
    {
        return $this->subDays();
    }

    /**
     * Remove days from the instance
     *
     * @param int $value
     *
     * @return static
     */
    public function subDays(int $value = 1): static
    {
        return $this->addDays(-1 * $value);
    }

    /**
     * Add weeks to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param int $value
     *
     * @return static
     */
    public function addWeeks(int $value = 1): static
    {
        return $this->modify("$value week");
    }

    /**
     * Add a week to the instance
     *
     * @return static
     */
    public function addWeek(): static
    {
        return $this->addWeeks();
    }

    /**
     * Remove a week from the instance
     * @return static
     */
    public function subWeek(): static
    {
        return $this->subWeeks();
    }

    /**
     * Remove weeks to the instance
     *
     * @param int $value
     *
     * @return static
     */
    public function subWeeks(int $value = 1): static
    {
        return $this->addWeeks(-1 * $value);
    }

    /**
     * Add hours to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param int $value
     *
     * @return static
     */
    public function addHours(int $value = 1): static
    {
        return $this->modify("$value hour");
    }

    /**
     * Add an hour to the instance
     *
     * @return static
     */
    public function addHour(): static
    {
        return $this->addHours();
    }

    /**
     * Remove an hour from the instance
     *
     * @return static
     */
    public function subHour(): static
    {
        return $this->subHours();
    }

    /**
     * Remove hours from the instance
     *
     * @param int $value
     *
     * @return static
     */
    public function subHours(int $value = 1): static
    {
        return $this->addHours(-1 * $value);
    }

    /**
     * Add minutes to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param int $value
     *
     * @return static
     */
    public function addMinutes(int $value = 1): static
    {
        return $this->modify("$value minute");
    }

    /**
     * Add a minute to the instance
     *
     * @return static
     */
    public function addMinute(): static
    {
        return $this->addMinutes();
    }

    /**
     * Remove a minute from the instance
     *
     * @return static
     */
    public function subMinute(): static
    {
        return $this->subMinutes();
    }

    /**
     * Remove minutes from the instance
     *
     * @param int $value
     *
     * @return static
     */
    public function subMinutes(int $value = 1): static
    {
        return $this->addMinutes(-1 * $value);
    }

    /**
     * Add seconds to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param int $value
     *
     * @return static
     */
    public function addSeconds(int $value = 1): static
    {
        return $this->modify("$value second");
    }

    /**
     * Add a second to the instance
     *
     * @return static
     */
    public function addSecond(): static
    {
        return $this->addSeconds();
    }

    /**
     * Remove a second from the instance
     *
     * @return static
     */
    public function subSecond(): static
    {
        return $this->subSeconds();
    }

    /**
     * Remove seconds from the instance
     *
     * @param int $value
     *
     * @return static
     */
    public function subSeconds(int $value = 1): static
    {
        return $this->addSeconds(-1 * $value);
    }
}
