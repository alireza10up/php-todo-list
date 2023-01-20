<?php

namespace Hekmatinasser\Jalali\Exceptions;

use InvalidArgumentException;
use Throwable;

class InvalidDatetimeException extends InvalidArgumentException
{
    /**
     * Constructor.
     *
     * @param string $datetime
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(private $datetime, $code = 0, Throwable $previous = null)
    {
        parent::__construct("Unknown datetime '$datetime'.", $code, $previous);
    }

    /**
     * Get the datetime.
     *
     * @return string
     */
    public function datetime(): string
    {
        return $this->datetime;
    }
}
