<?php

namespace Hekmatinasser\Jalali\Traits;

use DateTime;
use Hekmatinasser\Jalali\Jalali;

trait Comparison
{
    /**
     * Determines if the instance is equal to another
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     */
    public function eq(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this == new static($datetime);
    }

    /**
     * Determines if the instance is equal to another
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     * @see eq()
     */
    public function equalTo(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this->eq($datetime);
    }

    /**
     * Determines if the instance is not equal to another
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     */
    public function ne(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return ! $this->eq($datetime);
    }

    /**
     * Determines if the instance is not equal to another
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     * @see ne()
     */
    public function notEqualTo(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this->ne($datetime);
    }

    /**
     * Determines if the instance is greater (after) than another
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     */
    public function gt(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this > new static($datetime);
    }

    /**
     * Determines if the instance is greater (after) than another
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     * @see gt()
     */
    public function greaterThan(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this->gt($datetime);
    }

    /**
     * Determines if the instance is greater (after) than or equal to another
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     */
    public function gte(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this >= new static($datetime);
    }

    /**
     * Determines if the instance is greater (after) than or equal to another
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     * @see gte()
     */
    public function greaterThanOrEqualTo(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this->gte($datetime);
    }

    /**
     * Determines if the instance is less (before) than another
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     */
    public function lt(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this < new static($datetime);
    }

    /**
     * Determines if the instance is less (before) than another
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     * @see lt()
     */
    public function lessThan(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this->lt($datetime);
    }

    /**
     * Determines if the instance is less (before) or equal to another
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     */
    public function lte(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this <= new static($datetime);
    }

    /**
     * Determines if the instance is less (before) or equal to another
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     * @see lte()
     */
    public function lessThanOrEqualTo(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this->lte($datetime);
    }

    /**
     * Determines if the instance is between two others
     * @param Jalali|DateTime|string|int|null $first
     * @param Jalali|DateTime|string|int|null $second
     * @param bool $equal Indicates if a > and < comparison should be used or <= or >=
     * @return bool
     */
    public function between(Jalali|DateTime|string|int|null $first, Jalali|DateTime|string|int|null $second, bool $equal = true): bool
    {
        list($less, $greater) = $first->lt($second) ? [$first, $second] : [$second, $first];
        if ($equal) {
            return $this->gte($less) && $this->lte($greater);
        }

        return $this->gt($less) && $this->lt($greater);
    }

    /**
     * Get the closest date from the instance.
     * @param Jalali|DateTime|string|int|null $first
     * @param Jalali|DateTime|string|int|null $second
     * @return static
     */
    public function closest(Jalali|DateTime|string|int|null $first, Jalali|DateTime|string|int|null $second): static
    {
        return $this->diffSeconds($first) < $this->diffSeconds($second) ? $first : $second;
    }

    /**
     * Get the farthest date from the instance.
     * @param Jalali|DateTime|string|int|null $first
     * @param Jalali|DateTime|string|int|null $second
     * @return static
     */
    public function farthest(Jalali|DateTime|string|int|null $first, Jalali|DateTime|string|int|null $second): static
    {
        return $this->diffSeconds($first) > $this->diffSeconds($second) ? $first : $second;
    }

    /**
     * Get the minimum instance between a given instance (default now) and the current instance.
     * @param Jalali|DateTime|string|int|null $datetime
     * @return static
     */
    public function min(Jalali|DateTime|string|int|null $datetime): static
    {
        return $this->lt($datetime) ? $this : new static($datetime);
    }

    /**
     * Get the minimum instance between a given instance (default now) and the current instance.
     * @param Jalali|DateTime|string|int|null $datetime
     * @return static
     * @see min()
     */
    public function minimum(Jalali|DateTime|string|int|null $datetime): static
    {
        return $this->min($datetime);
    }

    /**
     * Get the maximum instance between a given instance (default now) and the current instance.
     * @param Jalali|DateTime|string|int|null $datetime
     * @return static
     */
    public function max(Jalali|DateTime|string|int|null $datetime): static
    {
        return $this->gt($datetime) ? $this : new static($datetime);
    }

    /**
     * Get the maximum instance between a given instance (default now) and the current instance.
     * @param Jalali|DateTime|string|int|null $datetime
     * @return static
     * @see max()
     */
    public function maximum(Jalali|DateTime|string|int|null $datetime): static
    {
        return $this->max($datetime);
    }

    /**
     * Determines if the instance is a weekday
     * @return bool
     */
    public function isWeekday(): bool
    {
        return ! $this->isWeekend();
    }

    /**
     * Determines if the instance is a weekend day
     * @return bool
     */
    public function isWeekend(): bool
    {
        return in_array($this->dayOfWeek, static::$weekendDays);
    }

    /**
     * Determines if the instance is yesterday
     * @return bool
     */
    public function isYesterday(): bool
    {
        return $this->formatDate() === static::yesterday($this->getTimezone())->formatDate();
    }

    /**
     * Determines if the instance is today
     * @return bool
     */
    public function isToday(): bool
    {
        return $this->formatDate() === static::now($this->getTimezone())->formatDate();
    }

    /**
     * Determines if the instance is tomorrow
     * @return bool
     */
    public function isTomorrow(): bool
    {
        return $this->formatDate() === static::tomorrow($this->getTimezone())->formatDate();
    }

    /**
     * Determines if the instance is within the next week
     * @return bool
     */
    public function isNextWeek(): bool
    {
        return $this->weekOfYear === static::now($this->getTimezone())->addWeek()->weekOfYear;
    }

    /**
     * Determines if the instance is within the last week
     * @return bool
     */
    public function isLastWeek(): bool
    {
        return $this->weekOfYear === static::now($this->getTimezone())->subWeek()->weekOfYear;
    }

    /**
     * Determines if the instance is within the next month
     * @return bool
     */
    public function isNextMonth(): bool
    {
        return $this->format('Y-m') === static::now($this->getTimezone())->addMonth()->format('Y-m');
    }

    /**
     * Determines if the instance is within the last month
     * @return bool
     */
    public function isLastMonth(): bool
    {
        return $this->format('Y-m') === static::now($this->getTimezone())->subMonth()->format('Y-m');
    }

    /**
     * Determines if the instance is within next year
     * @return bool
     */
    public function isNextYear(): bool
    {
        return $this->year === static::now($this->getTimezone())->addYear()->year;
    }

    /**
     * Determines if the instance is within the previous year
     * @return bool
     */
    public function isLastYear(): bool
    {
        return $this->year === static::now($this->getTimezone())->subYear()->year;
    }

    /**
     * Determines if the instance is in the future, greater (after) than now
     * @return bool
     */
    public function isFuture(): bool
    {
        return $this->gt();
    }

    /**
     * Determines if the instance is in the past, less (before) than now
     * @return bool
     */
    public function isPast(): bool
    {
        return $this->lt();
    }

    /**
     * Compares the formatted values of the two dates.
     * @param string $format The date formats to compare.
     * @param Jalali|DateTime|string|int|null $datetime The instance to compare with or null to use current day.
     * @return bool
     */
    public function isSameAs(string $format, Jalali|DateTime|string|int|null $datetime = null): bool
    {
        $datetime = new static($datetime);

        return $this->format($format) === $datetime->format($format);
    }

    /**
     * Determines if the instance is in the current year
     * @return bool
     */
    public function isCurrentYear(): bool
    {
        return $this->isSameYear();
    }

    /**
     * Determines if the instance is in the current month
     * @return bool
     */
    public function isCurrentMonth(): bool
    {
        return $this->isSameMonth();
    }

    /**
     * Checks if the passed in date is in the same year as the instance year.
     * @param Jalali|null $datetime The instance to compare with or null to use current day.
     * @return bool
     */
    public function isSameYear(Jalali $datetime = null): bool
    {
        return $this->isSameAs('Y', $datetime);
    }

    /**
     * Checks if the passed in date is in the same month as the instance month (and year if needed).
     * @param Jalali|DateTime|string|int|null $datetime The instance to compare with or null to use current day.
     * @param bool $sameYear Check if it is the same month in the same year.
     * @return bool
     */
    public function isSameMonth(Jalali|DateTime|string|int|null $datetime = null, bool $sameYear = false): bool
    {
        return $this->isSameAs($sameYear ? 'Y-m' : 'm', $datetime);
    }

    /**
     * Checks if the passed in date is the same day as the instance current day.
     * @param Jalali|DateTime|string|int|null $datetime
     * @return bool
     */
    public function isSameDay(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this->isSameAs('Y-m-d', $datetime);
    }

    /**
     * Check if date the birthday. Compares the date/month values of the two dates.
     * @param Jalali|DateTime|string|int|null $datetime The instance to compare with or null to use current day.
     * @return bool
     */
    public function isBirthday(Jalali|DateTime|string|int|null $datetime = null): bool
    {
        return $this->isSameAs('m-d', $datetime);
    }

    /**
     * Checks if this day is a Saturday.
     * @return bool
     */
    public function isSaturday(): bool
    {
        return $this->dayOfWeek === static::SATURDAY;
    }

    /**
     * Checks if this day is a Sunday.
     * @return bool
     */
    public function isSunday(): bool
    {
        return $this->dayOfWeek === static::SUNDAY;
    }

    /**
     * Checks if this day is a Monday.
     * @return bool
     */
    public function isMonday(): bool
    {
        return $this->dayOfWeek === static::MONDAY;
    }

    /**
     * Checks if this day is a Tuesday.
     * @return bool
     */
    public function isTuesday(): bool
    {
        return $this->dayOfWeek === static::TUESDAY;
    }

    /**
     * Checks if this day is a Wednesday.
     * @return bool
     */
    public function isWednesday(): bool
    {
        return $this->dayOfWeek === static::WEDNESDAY;
    }

    /**
     * Checks if this day is a Thursday.
     * @return bool
     */
    public function isThursday(): bool
    {
        return $this->dayOfWeek === static::THURSDAY;
    }

    /**
     * Checks if this day is a Friday.
     * @return bool
     */
    public function isFriday(): bool
    {
        return $this->dayOfWeek === static::FRIDAY;
    }
}
