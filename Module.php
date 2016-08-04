<?php

namespace ThirdPartyAuthModule;

use PPI\Framework\Module\AbstractModule;

class Module extends AbstractModule
{

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ThirdPartyAuthModule';
    }

    /**
     * Get the routes for this module
     *
     * @return \Symfony\Component\Routing\RouteCollection
     */
    public function getRoutes()
    {
        return $this->loadSymfonyRoutes(__DIR__ . '/resources/routes/symfony.yml');
    }

    /**
     * Get the configuration for this module
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->loadConfig(__DIR__ . '/resources/config/config.yml');
    }

    /**
     * Get the configuration for the Autoloader
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/',
                ),
            ),
        );
    }

    /**
     * Get the service configuration
     *
     * @return array
     */
    public function getServiceConfig()
    {
        return array('factories' => array(
            'admin.users.storage' => function ($sm) {
                 return new \AdminModule\Storage\User($sm->get('datasource')->getConnection('main'));
            },

            'fb.auth' => function ($sm) {
                return new \ThirdPartyAuthModule\Classes\FacebookAuth();
            }
        ));
    }
}
