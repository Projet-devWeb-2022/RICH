<?php

namespace App\Security\EntryPoint;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class UserEntryPoint implements AuthenticationEntryPointInterface
{
    public function __construct(Private UrlGeneratorInterface $urlGenerator){}

    public function start(Request $request, AuthenticationException $authException = null) : Response
    {
        return new RedirectResponse($this->urlGenerator->generate('app_login'));
    }
}