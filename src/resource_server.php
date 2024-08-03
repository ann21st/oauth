<?php

use App\Repository\AccessTokenRepository;
use League\OAuth2\Server\ResourceServer;

$accessTokenRepository = new AccessTokenRepository(); // instance of AccessTokenRepositoryInterface

// Path to authorization server's public key
$publicKeyPath = __DIR__ . '/../ssl/public.key';

// Setup the authorization server
$server = new ResourceServer(
    $accessTokenRepository,
    $publicKeyPath
);
