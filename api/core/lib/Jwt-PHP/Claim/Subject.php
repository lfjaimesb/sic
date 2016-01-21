<?php

namespace Lib\Jwt\Claim;

class Subject extends AbstractClaim
{
    const NAME = 'sub';

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}
