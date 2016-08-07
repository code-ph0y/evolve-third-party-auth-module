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

    private $scope = array();

    public function __construct($service_type, $client_key, $client_secret)
    {
        // Create the service factory
        if (is_null($this->serviceFactory)) {
            $this->serviceFactory = new ServiceFactory();
        }

        // Store client id
        $this->clientId = $client_key;

        // Store client secret
        $this->clientSecret = $client_secret;

        return $this->authorise();
    }

    public function authorise()
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

        // Create a new Service
        $service = new FacebookService($credentials, );
    }
}
