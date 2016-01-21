<?php

namespace Lib\Jwt\Verification;

use Lib\Jwt\Claim;
use Lib\Jwt\Encoding;
use Lib\Jwt\Exception\VerificationException;
use Lib\Jwt\HeaderParameter;
use Lib\Jwt\Token;

class ExpirationVerifier implements VerifierInterface
{
    /**
     * @param Claim\Expiration $expirationClaim
     * @throws \InvalidArgumentException
     * @return \DateTime
     */
    private function getDateTimeFromClaim(Claim\Expiration $expirationClaim)
    {
        if (!is_long($expirationClaim->getValue())) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid expiration timestamp "%s"',
                $expirationClaim->getValue()
            ));
        }

        $expiration = new \DateTime();
        $expiration->setTimestamp($expirationClaim->getValue());
        return $expiration;
    }

    public function verify(Token $token)
    {
        /** @var Claim\Expiration $expirationClaim */
        $expirationClaim = $token->getPayload()->findClaimByName(Claim\Expiration::NAME);

        if (null === $expirationClaim) {
            return null;
        }

        $now = new \DateTime('now', new \DateTimeZone('UTC'));

        if ($now->getTimestamp() > $expirationClaim->getValue()) {
            $expiration = $this->getDateTimeFromClaim($expirationClaim);
            throw new VerificationException(sprintf('Token expired at "%s"', $expiration->format('r')));
        }
    }
}
