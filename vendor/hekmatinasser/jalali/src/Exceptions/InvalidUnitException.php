<?php

namespace Hekmatinasser\Jalali\Exceptions;

use InvalidArgumentException;
use Throwable;

class InvalidUnitException extends InvalidArgumentException
{
    /**
     * Constructor.
     *
     * @param string $unit
     * @param $value
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(private $unit, private $value, $code = 0, Throwable $previous = null)
    {
        parent::__construct("Invalid $this->unit '$value'", $code, $previous);
    }

    /**
     * Get the unit.
     *
     * @return string
     */
    public function unit(): string
    {
        return $this->unit;
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
