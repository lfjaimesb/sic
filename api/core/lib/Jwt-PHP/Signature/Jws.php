<?php

namespace Lib\Jwt\Signature;

use Lib\Jwt\Encoding\EncoderInterface;
use Lib\Jwt\Encryption\EncryptionInterface;
use Lib\Jwt\HeaderParameter\Algorithm;
use Lib\Jwt\Token;

class Jws implements SignerInterface
{
    /**
     * @var EncryptionInterface
     */
    private $encryption;

    /**
     * @var EncoderInterface
     */
    private $encoder;

    public function __construct(EncryptionInterface $encryption, EncoderInterface $encoder)
    {
        $this->encryption = $encryption;
        $this->encoder    = $encoder;
    }

    public function getUnsignedValue(Token $token)
    {
        $jsonHeader    = $token->getHeader()->getParameters()->jsonSerialize();
        $encodedHeader = $this->encoder->encode($jsonHeader);

        $jsonPayload    = $token->getPayload()->getClaims()->jsonSerialize();
        $encodedPayload = $this->encoder->encode($jsonPayload);

        return sprintf('%s.%s', $encodedHeader, $encodedPayload);
    }

    public function sign(Token $token)
    {
        $token->addHeader(new Algorithm($this->encryption->getAlgorithmName()));

        $rawSignature = $this->getUnsignedValue($token);

        $signature = $this->encryption->encrypt($rawSignature);

        $token->setSignature($signature);
    }
}
