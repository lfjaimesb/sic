<?php

namespace Lib\Jwt\Encoding;

interface EncoderInterface
{
    /**
     * @param string $value
     * @return string
     */
    public function encode($value);

    /**
     * @param string $value
     * @return string
     */
    public function decode($value);
}
