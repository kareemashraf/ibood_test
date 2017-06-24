<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class ApiKeyUserProvider
 * @package AppBundle\Security
 */
class ApiKeyUserProvider implements UserProviderInterface
{

    public function loadUserByUsername($username)
    {
        // TODO: Implement loadUserByUsername() method.
    }

    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    public function supportsClass($class)
    {
        // TODO: Implement supportsClass() method.
    }

    public function getUsernameForApiKey($apiKey)
    {

    }
}