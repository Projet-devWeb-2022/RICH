<?php

namespace App\Security\badges;

class SecretAccessBadge implements \Symfony\Component\Security\Http\Authenticator\Passport\Badge\BadgeInterface
{
    private bool $resolved = false;

    public function __construct(private UserRepository $userRepository)
    {
    }


    public function check(?UserInterface $userBadge){
        if($userBadge){
            $this->resolved = ($this->userRepository->findOneBy(['email'=>$userBadge->getUserIdentifier()]))->getSecretaccess()??false;
        }
    }

    public function isResolved(): bool
    {
        if (!$this->resolved)
            throw new SecretAccessException('FORBIDDEN', Response::HTTP_FORBIDDEN);
        return $this->resolved;
    }
}