<?php

namespace Lib\Jwt\Verification;

use Lib\Jwt\Claim;
use Lib\Jwt\Encoding;
use Lib\Jwt\Exception\VerificationException;
use Lib\Jwt\HeaderParameter;
use Lib\Jwt\Token;

class NotBeforeVerifier implements VerifierInterface
{
    public function verify(Token $token)
    {
        /** @var Claim\NotBefore $notBeforeClaim */
        $notBeforeClaim = $token->getPayload()->findClaimByName(Claim\NotBefore::NAME);

        if (null === $notBeforeClaim) {
            return null;
        }

        $now = new \DateTime('now', new \DateTimeZone('UTC'));

        if (!is_long($notBeforeClaim->getValue())) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid not before timestamp "%s"',
                $notBeforeClaim->getValue()
            ));
        }

        if ($now->getTimestamp() < $notBeforeClaim->getValue()) {
            $notBefore = new \DateTime();
            $notBefore->setTimestamp($notBeforeClaim->getValue());
            throw new VerificationException(sprintf('Token must not be processed before "%s"', $notBefore->format('r')));
        }
    }
}
