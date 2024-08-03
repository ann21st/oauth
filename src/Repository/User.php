<?php
namespace App\Repository;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

class User implements UserRepositoryInterface
{
    public function getUserEntityByUserCredentials(string $username, string $password, string $grantType, ClientEntityInterface $clientEntity): ?UserEntityInterface
    {
        // TODO: Implement getUserEntityByUserCredentials() method.
    }
}
