<?php

namespace Hekmatinasser\Jalali\Traits;

use Hekmatinasser\Jalali\JalaliInterface;

trait Date
{
    use Accessor;
    use Comparison;
    use Creator;
    use Formatting;
    use Modification;
    use Transformation;
    use Translator;
    use Boundaries;
    use Difference;
    use Validation;

    /**
     * Format to use for __toString.
     *
     * @var string
     */
    protected static string $stringFormat = JalaliInterface::DEFAULT_STRING_FORMAT;

    /**
     * First day of week.
     *
     * @var int
     */
    protected static int $weekStartsAt = JalaliInterface::SATURDAY;

    /**
     * Last day of week.
     *
     * @var int
     */
    protected static int $weekEndsAt = JalaliInterface::FRIDAY;

    /**
     * Days of weekend.
     *
     * @var array
     */
    protected static array $weekendDays = [JalaliInterface::THURSDAY, JalaliInterface::FRIDAY];

    /**
     * number day in months gregorian
     *
     * @var array
     */
    protected static array $daysMonthGregorian = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    /**
     * number day in month jalali
     *
     * @var array
     */
    protected static array $daysMonthJalali = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
}
