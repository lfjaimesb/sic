<?php

namespace Lib\Jwt\Serialization;

use Lib\Jwt\Token;

interface SerializerInterface
{
    /**
     * @param string $jwt
     * @return Token
     */
    public function deserialize($jwt);

    /**
     * @param Token $token
     * @return string
     */
    public function serialize(Token $token);
}
