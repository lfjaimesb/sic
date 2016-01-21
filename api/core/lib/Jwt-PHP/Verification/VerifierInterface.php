<?php

namespace Lib\Jwt\Verification;

use Lib\Jwt\Token;

interface VerifierInterface
{
    /**
     * @param Token $token
     * @return void
     */
    public function verify(Token $token);
}
