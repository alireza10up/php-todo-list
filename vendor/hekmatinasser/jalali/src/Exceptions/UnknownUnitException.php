<?php

namespace Hekmatinasser\Jalali\Exceptions;

use InvalidArgumentException;
use Throwable;

class UnknownUnitException extends InvalidArgumentException
{
    /**
     * Constructor.
     *
     * @param string $unit
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(private $unit, $code = 0, Throwable $previous = null)
    {
        parent::__construct("Unknown unit '$unit'.", $code, $previous);
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
}
