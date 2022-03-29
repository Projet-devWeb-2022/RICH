<?php

namespace App\Security\badges;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

class UserAgentNotAuthorizedException extends AuthenticationException
{}