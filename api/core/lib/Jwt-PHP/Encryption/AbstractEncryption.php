<?php

namespace Lib\Jwt\Encryption;

use Lib\Jwt\Algorithm;

abstract class AbstractEncryption
{
    /**
     * @var Algorithm\AlgorithmInterface
     */
    protected $algorithm;

    /**
     * @param Algorithm\AlgorithmInterface $algorithm
     */
    public function __construct(Algorithm\AlgorithmInterface $algorithm)
    {
        $this->algorithm = $algorithm;
    }

    /**
     * @return string
     */
    public function getAlgorithmName()
    {
        return $this->algorithm->getName();
    }
}
