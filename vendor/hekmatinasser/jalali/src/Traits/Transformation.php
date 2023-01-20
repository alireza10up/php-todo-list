<?php

namespace Hekmatinasser\Jalali\Traits;

use DateTime;
use Exception;

trait Transformation
{
    /**
     * convert gregorian to jalali
     *
     * @param int $gregorianYear
     * @param int $gregorianMonth
     * @param int $gregorianDay
     * @return array
     */
    public static function GregorianToJalali(int $gregorianYear, int $gregorianMonth, int $gregorianDay): array
    {
        $gregorianYear = $gregorianYear - 1600;
        $gregorianMonth = $gregorianMonth - 1;
        $gregorianDayNumber = (365 * $gregorianYear + ((int)(($gregorianYear + 3) / 4)) - ((int)(($gregorianYear + 99) / 100)) + ((int)(($gregorianYear + 399) / 400)));
        for ($i = 0; $i < $gregorianMonth; ++$i) {
            $gregorianDayNumber += static::$daysMonthGregorian[$i];
        }
        if ($gregorianMonth > 1 && (($gregorianYear % 4 == 0 && $gregorianYear % 100 != 0) || ($gregorianYear % 400 == 0))) {
            # leap and after Feb
            $gregorianDayNumber++;
        }
        $gregorianDayNumber += $gregorianDay - 1;
        $jalaliDay = $gregorianDayNumber - 79;
        $jalaliNumber = (int)($jalaliDay / 12053);
        $jalaliDay = $jalaliDay % 12053;
        $jalaliYear = (979 + 33 * $jalaliNumber + 4 * ((int)($jalaliDay / 1461)));
        $jalaliDay %= 1461;
        if ($jalaliDay >= 366) {
            $jalaliYear += ((int)(($jalaliDay - 1) / 365));
            $jalaliDay = ($jalaliDay - 1) % 365;
        }
        for ($i = 0; ($i < 11 && $jalaliDay >= static::$daysMonthJalali[$i]); ++$i) {
            $jalaliDay -= static::$daysMonthJalali[$i];
        }

        return [$jalaliYear, $i + 1, $jalaliDay + 1];
    }

    /**
     * convert jalali to gregorian
     *
     * @param int $jalaliYear
     * @param int $jalaliMonth
     * @param int $jalaliDay
     * @return array
     */
    public static function jalaliToGregorian(int $jalaliYear, int $jalaliMonth, int $jalaliDay): array
    {
        $jalaliYear = $jalaliYear - 979;
        $jalaliMonth = $jalaliMonth - 1;
        $jalaliDayNumber = (365 * $jalaliYear + ((int)($jalaliYear / 33)) * 8 + ((int)(($jalaliYear % 33 + 3) / 4)));
        for ($index = 0; $index < $jalaliMonth; ++$index) {
            $jalaliDayNumber += static::$daysMonthJalali[$index];
        }
        $jalaliDayNumber += $jalaliDay - 1;
        $gregorianDay = $jalaliDayNumber + 79;
        $gregorianYear = (1600 + 400 * ((int)($gregorianDay / 146097)));
        $gregorianDay = $gregorianDay % 146097;
        $leap = 1;
        if ($gregorianDay >= 36525) { # 36525 = (365 * 100 + 100 / 4)
            $gregorianDay--;
            $gregorianYear += (100 * ((int)($gregorianDay / 36524)));
            $gregorianDay = $gregorianDay % 36524;
            if ($gregorianDay >= 365) {
                $gregorianDay++;
            } else {
                $leap = 0;
            }
        }
        $gregorianYear += (4 * ((int)($gregorianDay / 1461)));
        $gregorianDay %= 1461;
        if ($gregorianDay >= 366) {
            $leap = 0;
            $gregorianDay--;
            $gregorianYear += ((int)($gregorianDay / 365));
            $gregorianDay = ($gregorianDay % 365);
        }
        for ($gregorianMonth = 0; $gregorianDay >= (static::$daysMonthGregorian[$gregorianMonth] + ($gregorianMonth == 1 && $leap)); $gregorianMonth++) {
            $gregorianDay -= (static::$daysMonthGregorian[$gregorianMonth] + ($gregorianMonth == 1 && $leap));
        }

        return [$gregorianYear, $gregorianMonth + 1, $gregorianDay + 1];
    }

    /**
     * Create a DateTime instance from Jalali
     *
     * @return DateTime $datetime
     * @throws Exception
     */
    public function datetime(): DateTime
    {
        $datetime = new DateTime("@{$this->getTimestamp()}");

        return $datetime->setTimezone($this->getTimezone());
    }
}
