<?php
namespace Zf2ClientMoysklad;

use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zf2ClientMoysklad\Options\ModuleOptions;

class Module implements AutoloaderProviderInterface, ServiceProviderInterface
{
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'zf2clientmoysklad_module_options' => function ($sm) {
                    $config = $sm->get('config');
                    return new ModuleOptions(isset($config['zf2clientmoysklad']) ?
                                                   $config['zf2clientmoysklad'] :
                                                   array());
                }
            )
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}