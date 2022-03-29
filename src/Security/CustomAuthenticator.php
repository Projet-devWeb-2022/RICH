<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authenticator\InteractiveAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class CustomAuthenticator implements InteractiveAuthenticatorInterface
{
    /**
     * @param UserProviderInterface $userProvider
     */
    public function __construct(private UserProviderInterface $userProvider,
    ){}



    /**
     * @param Request $request
     * @return PassportInterface
     */
    public function authenticate(Request $request): Passport
    {
        $email = $request->server->get('PHP_AUTH_USER', '');
        $pwd = $request->server->get('PHP_AUTH_PW', '');
        return new Passport(
            new UserBadge($email, [$this->userProvider, 'loadUserByIdentifier']),
            new PasswordCredentials($pwd)
        );
    }


    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $firewallName
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response|null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $code = 403;
        $message = 'FORBIDDEN';
        if ($exception instanceof TooManyLoginAttemptsAuthenticationException) {
            $code = Response::HTTP_UNAUTHORIZED;
            $message = 'Too many failed login attempts, please try again in a few minutes.';
            $MessageData = $exception->getMessageData();
            if (is_array($MessageData)) {
                if (key_exists('%minutes%', $MessageData)) {
                    $message = $exception->getMessageKey();
                    $message = str_replace("%minutes%", $MessageData['%minutes%'], $message);
                }
            }
        } else if ($exception instanceof BadCredentialsException) {
            $code = 401;
            $message = $exception->getMessage();
        } else if ($exception instanceof UserAgentNotAuthorizedException) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
        }
        return new JsonResponse(['error' => $message], $code);
    }

    public function isInteractive(): bool
    {
        return true;
    }

    public function createToken(Passport $passport, string $firewallName): TokenInterface
    {
        return new UsernamePasswordToken($passport->getUser(), null, $firewallName, $passport->getUser()->getRoles());
    }

    public function supports(Request $request): ?bool
    {
        return null;
    }
}