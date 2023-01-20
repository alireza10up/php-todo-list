<?php

namespace Hekmatinasser\Jalali\Exceptions;

use InvalidArgumentException;
use Throwable;

class UnknownGetterException extends InvalidArgumentException
{
    /**
     * Constructor.
     *
     * @param string $getter   getter name
     * @param int code
     * @param Throwable|null $previous
     */
    public function __construct(private $getter, $code = 0, Throwable $previous = null)
    {
        parent::__construct("Unknown getter '$getter'", $code, $previous);
    }

    /**
     * Get the getter.
     *
     * @return string
     */
    public function getter(): string
    {
        return $this->getter;
    }
}
