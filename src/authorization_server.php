<?php

use App\Repository\AccessTokenRepository;
use App\Repository\AuthCodeRepository;
use App\Repository\ClientRepository;
use App\Repository\RefreshTokenRepository;
use App\Repository\ScopeRepository;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\AuthCodeGrant;

require __DIR__ . '/../vendor/autoload.php';

$clientRepository = new ClientRepository(); // instance of ClientRepositoryInterface
$scopeRepository = new ScopeRepository(); // instance of ScopeRepositoryInterface
$accessTokenRepository = new AccessTokenRepository(); // instance of AccessTokenRepositoryInterface
$authCodeRepository = new AuthCodeRepository(); // instance of AuthCodeRepositoryInterface
$refreshTokenRepository = new RefreshTokenRepository(); // instance of RefreshTokenRepositoryInterface

$privateKey = __DIR__ . '/../ssl/private.key';
$encryptionKey = '8jcaX7yn532ofjnStC9V5GBKebpMNLTlj/Z3nfO7F+w=';

$server = new AuthorizationServer(
    $clientRepository,
    $accessTokenRepository,
    $scopeRepository,
    $privateKey,
    $encryptionKey
);

$grant = new AuthCodeGrant(
    $authCodeRepository,
    $refreshTokenRepository,
    new \DateInterval('PT10M') // authorization codes will expire after 10 minutes
);

$grant->setRefreshTokenTTL(new \DateInterval('P1M'));
$server->enableGrantType(
    $grant,
    new \DateInterval('PT1H') // access tokens will expire after 1 hour
);
