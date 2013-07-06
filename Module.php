<?php
namespace Zf2ClientMoysklad;

use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

use Zf2ClientMoysklad\Mapper\GenericMapper;
use Zf2ClientMoysklad\Options\ModuleOptions;
use Zf2ClientMoysklad\Transport\GenericTransport;

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
                },
                'zf2clientmoysklad_entity_manager' => function ($sm) {
                    $mapper = new GenericMapper($sm->get('zf2clientmoysklad_generic_transport'));
                    return new EntityManager($mapper);
                },
                'zf2clientmoysklad_generic_transport' => function ($sm) {
                    $client = new \Zend\Http\Client();
                    $options = $sm->get('zf2clientmoysklad_module_options');
                    return new GenericTransport($options, $client);
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