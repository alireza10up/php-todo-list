<?php

namespace Hekmatinasser\Jalali\Exceptions;

use BadMethodCallException;
use Throwable;

class UnknownSetterException extends BadMethodCallException
{
    /**
     * Constructor.
     *
     * @param string $setter setter name
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(private $setter, $code = 0, Throwable $previous = null)
    {
        parent::__construct("Unknown setter '$setter'", $code, $previous);
    }

    /**
     * Get the setter.
     *
     * @return string
     */
    public function setter(): string
    {
        return $this->setter;
    }
}
