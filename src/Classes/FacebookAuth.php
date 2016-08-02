<?php
namespace ThirdPartyAuthModule\Classes;

use OAuth\OAuth2\Service\Facebook as FacebookService;

use OAuth\Common\Storage\Session;
use OAuth\ServiceFactory;
use OAuth\Common\Consumer\Credentials;

class FacebookAuth
{
    public function authenticate(array $config, $baseURL)
    {
        // Session storage
        $storage = new Session();

        // Setup the credentials for the requests
        $credentials = new Credentials(
            $config['appKey'],
            $config['appSecret'],
            $baseURL
        );

        // Create a new FB Service
        $fbService = new FacebookService($credentials);

        exit;
    }
}
