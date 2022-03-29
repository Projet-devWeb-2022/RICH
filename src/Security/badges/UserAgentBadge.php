<?php

namespace App\Security\badges;

class UserAgentBadge implements \Symfony\Component\Security\Http\Authenticator\Passport\Badge\BadgeInterface
{

    private bool $resolved;

    public function __construct(private Request $request){
        $this->resolved =  str_starts_with($this->request->headers->get("user-agent"), 'tPostman');
    }

    public function isResolved(): bool
    {
        if (!$this->resolved)
            throw new UserAgentNotAuthorizedException('User Agent FORBIDDEN', Response::HTTP_FORBIDDEN);
        return $this->resolved;
    }
}