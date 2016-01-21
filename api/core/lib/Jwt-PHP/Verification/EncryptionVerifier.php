<?php

namespace Lib\Jwt\Verification;

use Lib\Jwt\Algorithm;
use Lib\Jwt\Encoding;
use Lib\Jwt\Encryption;
use Lib\Jwt\Exception\VerificationException;
use Lib\Jwt\HeaderParameter;
use Lib\Jwt\Signature;
use Lib\Jwt\Token;

class EncryptionVerifier implements VerifierInterface
{
    /**
     * @var Encryption\EncryptionInterface
     */
    private $encryption;

    /**
     * @var Encoding\EncoderInterface
     */
    private $encoder;

    /**
     * @var Signature\Jws
     */
    protected $signer;

    /**
     * @param Encryption\EncryptionInterface $encryption
     * @param Encoding\EncoderInterface    $encoder
     */
    public function __construct(Encryption\EncryptionInterface $encryption, Encoding\EncoderInterface $encoder)
    {
        $this->encryption = $encryption;
        $this->encoder    = $encoder;
        $this->signer     = new Signature\Jws($this->encryption, $this->encoder);
    }

    /**
     * @param Token $token
     * @throws VerificationException
     */
    public function verify(Token $token)
    {
        /** @var HeaderParameter\Algorithm $algorithmParameter */
        $algorithmParameter = $token->getHeader()->findParameterByName(HeaderParameter\Algorithm::NAME);

        if (null === $algorithmParameter) {
            throw new \RuntimeException('Algorithm parameter not found in token header.');
        }

        if ($algorithmParameter->getValue() !== $this->encryption->getAlgorithmName()) {
            throw new \RuntimeException(sprintf(
                'Cannot use "%s" algorithm to decrypt token encrypted with algorithm "%s".',
                $this->encryption->getAlgorithmName(),
                $algorithmParameter->getValue()
            ));
        }

        if (!$this->encryption->verify($this->signer->getUnsignedValue($token), $token->getSignature())) {
            throw new VerificationException('Signature is invalid.');
        }
    }
}