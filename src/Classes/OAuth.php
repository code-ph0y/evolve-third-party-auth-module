<?php
namespace ThirdPartyAuthModule\Classes;

use OAuth\ServiceFactory as ServiceFactory;

use OAuth\Common\Storage\Session;
use OAuth\Common\Http\Client\ClientInterface;
use OAuth\Common\Consumer\Credentials;

class OAuth
{
    private $serviceFactory = null;

    private $clientId = null;

    private $clientSecret = null;

    private $scope = null;

    public function __construct(ServiceFactory $service_factory, $client_key, $client_secret)
    {

    }

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

        $sf = new ServiceFactory();

        // Create a new FB Service
        $fbService = new FacebookService($credentials, );
    }
}
