<?php

namespace Hekmatinasser\Jalali\Exceptions;

use InvalidArgumentException;
use Throwable;

class UnknownTimezoneException extends InvalidArgumentException
{
    /**
     * Constructor.
     *
     * @param string $timezone
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(private $timezone, $code = 0, Throwable $previous = null)
    {
        parent::__construct("Unknown unit '$timezone'.", $code, $previous);
    }

    /**
     * Get the unit.
     *
     * @return string
     */
    public function timezone(): string
    {
        return $this->timezone;
    }
}
