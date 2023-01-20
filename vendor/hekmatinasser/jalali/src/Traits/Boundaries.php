<?php

namespace Hekmatinasser\Jalali\Traits;

trait Boundaries
{
    /**
     * Resets the second to 00
     *
     * @return static
     */
    public function startMinute(): static
    {
        return $this->setTime($this->hour, $this->minute);
    }

    /**
     * Resets the second to 59
     *
     * @return static
     */
    public function endMinute(): static
    {
        return $this->setTime($this->hour, $this->minute, 59, 999999);
    }

    /**
     * Resets the minute and second to 00:00
     *
     * @return static
     */
    public function startHour(): static
    {
        return $this->setTime($this->hour, 0);
    }

    /**
     * Resets the minute and second to 59:59
     *
     * @return static
     */
    public function endHour(): static
    {
        return $this->setTime($this->hour, 59, 59, 999999);
    }

    /**
     * Resets the time to 00:00:00
     *
     * @return static
     */
    public function startDay(): static
    {
        return $this->setTime(0, 0);
    }

    /**
     * Resets the time to 23:59:59
     *
     * @return static
     */
    public function endDay(): static
    {
        return $this->setTime(23, 59, 59, 999999);
    }

    /**
     * Resets the date to the first day of week (defined in $weekStartsAt) and the time to 00:00:00
     *
     * @return static
     */
    public function startWeek(): static
    {
        $diff = ($this->dayOfWeek - static::$weekStartsAt);
        if ($diff > 0) {
            $this->subDays($diff);
        }

        return $this->startDay();
    }

    /**
     * Resets the date to end of week (defined in $weekEndsAt) and time to 23:59:59
     *
     * @return static
     */
    public function endWeek(): static
    {
        $diff = (static::$weekEndsAt - $this->dayOfWeek);
        if ($diff > 0) {
            $this->addDays($diff);
        }

        return $this->endDay();
    }

    /**
     * Resets the date to the first day of the month and the time to 00:00:00
     *
     * @return static
     */
    public function startMonth(): static
    {
        return $this->setDateTime($this->year, $this->month, 1, 0, 0);
    }

    /**
     * Resets the date to end of the month and time to 23:59:59
     *
     * @return static
     */
    public function endMonth(): static
    {
        return $this->setDateTime($this->year, $this->month, $this->daysInMonth, 23, 59, 59, 999999);
    }

    /**
     * Resets the date to the first day of the quarter and the time to 00:00:00
     *
     * @return static
     */
    public function startQuarter(): static
    {
        $month = ($this->quarter - 1) * static::MONTHS_PER_QUARTER + 1;

        return $this->setDateTime($this->year, $month, 1, 0, 0);
    }

    /**
     * Resets the date to end of the quarter and time to 23:59:59
     *
     * @return static
     */
    public function endQuarter(): static
    {
        $month = $this->quarter * static::MONTHS_PER_QUARTER;

        return $this->setDateJalali($this->year, $month, 1)->endMonth();
    }

    /**
     * Resets the date to the first day of the year and the time to 00:00:00
     *
     * @return static
     */
    public function startYear(): static
    {
        return $this->setDateTime($this->year, 1, 1, 0, 0);
    }

    /**
     * Resets the date to end of the year and time to 23:59:59
     *
     * @return static
     */
    public function endYear(): static
    {
        $year = $this->year;

        return $this->setDateTime($year, 12, static::isLeapYear($year) ? 30 : 29, 23, 59, 59, 999999);
    }
}
