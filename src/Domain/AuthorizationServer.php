<?php

namespace App\Domain;

use League\OAuth2\Client\Provider\GenericProvider;

class AuthorizationServer
{
    public function main()
    {
        $provider = new GenericProvider([
            'clientId'                => 'XXXXXX',    // The client ID assigned to you by the provider
            'clientSecret'            => 'XXXXXX',    // The client password assigned to you by the provider
            'redirectUri'             => 'https://my.example.com/your-redirect-url/',
            'urlAuthorize'            => 'https://service.example.com/authorize',
            'urlAccessToken'          => 'https://service.example.com/token',
            'urlResourceOwnerDetails' => 'https://service.example.com/resource'
        ]);
    }
}
