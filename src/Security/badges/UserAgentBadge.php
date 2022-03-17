<?php

namespace App\Security\badges;

class UserAgentBadge implements \Symfony\Component\Security\Http\Authenticator\Passport\Badge\BadgeInterface
{

    /**
     * @inheritDoc
     */
    public function isResolved(): bool
    {
        // TODO: Implement isResolved() method.
    }
}