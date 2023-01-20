<?php

namespace Hekmatinasser\Jalali\Traits;

use DateTime;
use Exception;
use Hekmatinasser\Jalali\Jalali;
use Hekmatinasser\Notowo\Notowo;

trait Formatting
{
    /**
     * Reset the format used to the default when type juggling a Jalali instance to a string
     */
    public static function resetFormat()
    {
        static::setFormat(static::DEFAULT_STRING_FORMAT);
    }

    /**
     * Set the default format used when type juggling a Jalali instance to a string
     *
     * @param string $format
     */
    public static function setFormat(string $format)
    {
        static::$stringFormat = $format;
    }

    /**
     * Format the instance as a string using the set format
     *
     * @return string
     */
    public function __toString()
    {
        return $this->format(static::$stringFormat);
    }

    /**
     * The format of the outputted date string (jalali equivalent of php date() function)
     *
     * @param string $format for example 'Y-m-d H:i:s'
     * @param bool $numberToWord
     * @return string
     */
    protected function date(string $format, bool $numberToWord = false): string
    {
        list($gregorianYear, $gregorianMonth, $gregorianDay, $gregorainWeek) = explode('-', parent::format('Y-m-d-w'));
        list($jalaliYear, $jalaliMonth, $jalaliDay) = static::GregorianToJalali($gregorianYear, $gregorianMonth, $gregorianDay);

        $jalaliWeek = (int) $gregorainWeek + 1;

        if ($jalaliWeek >= 7) {
            $jalaliWeek = 0;
        }

        $result = '';
        $timestamp = $this->getTimestamp();
        $chars = str_split($format);
        foreach ($chars as $char) {
            if ($char != '\\') {
                $output = $this->characterFormat($char, $timestamp, $jalaliYear, $jalaliMonth, $jalaliDay, $jalaliWeek);
                if ($numberToWord && is_numeric($output)) {
                    $output = (string) new Notowo($output, static::getLocale());
                }
                $result .= $output;
            }
        }

        return $result;
    }

    /**
     * The format of the outputted date character (jalali equivalent of php date() function)
     *
     * @param string $char
     * @param int $timestamp
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $week
     * @return int|string
     */
    private function characterFormat(string $char, int $timestamp, int $year, int $month, int $day, int $week): int|string
    {
        return match ($char) {
            '-' => '-',
            ':' => ':',
            '/' => '/',
            ' ' => ' ',
            'd' => sprintf('%02s', $day),
            'D' => substr(static::$messages['weekdays'][$week + 1], 0, 1),
            'j' => $day,
            'l' => static::$messages['weekdays'][$week + 1],
            'N' => $week + 1,
            'w' => $week,
            'z' => array_sum(array_slice(static::$daysMonthJalali, 0, $month - 1)) + $day,
            'S' => static::$messages['phrase']['th'],
            'W' => $this->dayOfWeek(),
            'F' => static::$messages['year_months'][$month],
            'm' => sprintf('%02s', $month),
            'M' => substr(static::$messages['year_months'][$month], 0, 3),
            'n' => $month,
            't' => static::isLeapYear($year) && ($month == 12) ? 30 : static::$daysMonthJalali[$month - 1],
            'q' => (int) ceil($this->month / static::MONTHS_PER_QUARTER),
            'Q' => static::$messages['quarters'][(int) ceil($this->month / static::MONTHS_PER_QUARTER)],
            'L' => (int) $this->isLeapYear($year),
            'Y', 'o' => $year,
            'y' => substr($year, 2),
            'a' => static::$messages['phrase'][parent::format('a')],
            'A' => static::$messages['phrase'][parent::format('a') == 'am' ? 'ante_meridiem' : 'post_meridiem'],
            'B', 'g', 'G', 'h', 'H', 's', 'u', 'i', 'e', 'I', 'O', 'P', 'T', 'Z' => parent::format($char),
            'c' => ("$year-$month-$day " . parent::format('H:i:s P')),
            'r' => (substr(static::$messages['weekdays'][$week], 0, 1) . "، $day " . static::$messages['year_months'][$month] . " $year " . parent::format('H:i:s P')),
            'U' => $timestamp,
            default => $char,
        };
    }

    /**
     * return week number from first of year
     *
     * @return int
     */
    protected function dayOfWeek(): int
    {
        $offset = (int) $this->clone()->startYear()->format('w');
        $days = (int) $this->format('z');

        return ceil(($days + $offset) / static::DAYS_PER_WEEK);
    }

    /**
     * The format of the outputted date string (jalali equivalent of php strftime() function)
     *
     * @param string $format
     * @return string
     */
    protected function strftime(string $format): string
    {
        $strftime_date = [
            "%a" => "D",
            "%A" => "l",
            "%d" => "d",
            "%e" => "j",
            "%j" => "z",
            "%u" => "N",
            "%w" => "w",
            "%U" => "W",
            "%V" => "W",
            "%W" => "W",
            "%b" => "M",
            "%B" => "F",
            "%h" => "M",
            "%m" => "m",
            "%C" => "y",
            "%g" => "y",
            "%G" => "y",
            "%y" => "y",
            "%Y" => "Y",
            "%H" => "H",
            "%I" => "h",
            "%l" => "g",
            "%M" => "i",
            "%p" => "A",
            "%P" => "a",
            "%r" => "h:i:s A",
            "%R" => "H:i",
            "%S" => "s",
            "%T" => "H:i:s",
            "%X" => "h:i:s",
            "%z" => "H",
            "%Z" => "H",
            "%c" => "D j M H:i:s",
            "%D" => "d/m/y",
            "%F" => "Y-m-d",
            "%s" => "U",
            "%x" => "d/m/y",
            "%n" => "\n",
            "%t" => "\t",
            "%%" => "%",
            "%Q" => "q",
            "%q" => "q",
        ];

        return str_replace(array_keys($strftime_date), array_values($strftime_date), $format);
    }

    /**
     * The format of the outputted date string (jalali equivalent of php strftime() function)
     *
     * @param string $format
     * @return string
     */
    public function format(string $format): string
    {
        return $this->date($this->strftime($format));
    }

    /**
     * The format of the outputted date string (gregorian)
     *
     * @param string $format
     * @return string
     * @throws Exception
     */
    public function formatGregorian(string $format): string
    {
        return $this->datetime()->format($format);
    }

    /**
     * Format the instance as date
     *
     * @return string
     */
    public function formatDatetime(): string
    {
        return $this->format('Y-m-d H:i:s');
    }

    /**
     * Format the instance as date
     *
     * @return string
     */
    public function formatDate(): string
    {
        return $this->format('Y-m-d');
    }

    /**
     * Format the instance as time
     *
     * @return string
     */
    public function formatTime(): string
    {
        return $this->format('H:i:s');
    }

    /**
     * Format the instance as date
     *
     * @return string
     */
    public function formatJalaliDatetime(): string
    {
        return $this->format('Y/n/j H:i:s');
    }

    /**
     * Format the instance as date
     *
     * @return string
     */
    public function formatJalaliDate(): string
    {
        return $this->format('Y/n/j');
    }

    /**
     * get difference in all
     *
     * @param Jalali|DateTime|string|int|null $datetime
     * @return string
     */
    public function formatDifference(Jalali|DateTime|string|int|null $datetime = null): string
    {
        $units = [
            static::SECONDS_PER_MINUTE,
            static::MINUTES_PER_HOUR,
            static::HOURS_PER_DAY,
            static::DAYS_PER_WEEK,
            static::WEEKS_PER_MONTH,
            static::MONTHS_PER_YEAR,
            static::YEARS_PER_DECADE,
            static::DECADE_PER_CENTURY,
        ];
        $difference = $this->diffSeconds(new static($datetime));
        $absolute = static::$messages['phrase'][$difference < 0 ? 'later' : 'ago'];

        $difference = abs($difference);

        for ($unit = 0; $difference >= $units[$unit] and $unit < count($units) - 1; $unit++) {
            $difference /= $units[$unit];
        }
        $difference = intval(round($difference));

        if ($difference === 0) {
            return static::$messages['phrase']['now'];
        }

        return sprintf('%s %s %s', $difference, array_values(static::$messages['date_units'])[$unit], $absolute);
    }

    /**
     * @param string $format
     * @return string
     */
    public function formatWord(string $format): string
    {
        return $this->date($this->strftime($format), true);
    }

    /**
     * Convert english numbers to persian numbers
     *
     * @param string $string
     * @return string
     */
    public static function enToFaNumbers(string $string): string
    {
        $en = static::getMessages('en');
        $fa = static::getMessages('fa');

        return str_replace(array_values($en['numbers']), array_values($fa['numbers']), $string);
    }

    /**
     * Convert english numbers to persian numbers
     *
     * @param string $string
     * @return string
     */
    public static function faToEnNumbers(string $string): string
    {
        $fa = static::getMessages('fa');
        $en = static::getMessages('en');

        return str_replace(array_values($fa['numbers']), array_values($en['numbers']), $string);
    }

    /**
     * Convert english numbers to persian numbers
     *
     * @param string $string
     * @return string
     */
    public static function arToEnNumbers(string $string): string
    {
        $ar = static::getMessages('ar');
        $en = static::getMessages('en');

        return str_replace(array_values($ar['numbers']), array_values($en['numbers']), $string);
    }
}
