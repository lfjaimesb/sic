<?php

namespace Lib\Jwt\Algorithm;

interface SymmetricInterface extends AlgorithmInterface
{
    /**
     * @param string $value
     * @return string
     */
    public function compute($value);
}
