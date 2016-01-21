<?php

namespace Lib\Jwt\Signature;

use Lib\Jwt\Token;

interface SignerInterface
{
    /**
     * @param Token $token
     */
    public function sign(Token $token);

    /**
     * @param Token $token
     * @return string
     */
    public function getUnsignedValue(Token $token);
}
