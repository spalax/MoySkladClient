<?php
namespace Zf2ClientMoysklad;

use Zend\Code\Annotation\AnnotationManager;
use Zend\Code\Scanner\DirectoryScanner;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

use Zf2ClientMoysklad\Code\Annotation\Parser\AnnotationParser;
use Zf2ClientMoysklad\Mapper\GenericMapper;
use Zf2ClientMoysklad\Metadata\Collector\EntityCollector;
use Zf2ClientMoysklad\Metadata\MetadataCollection;
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

                'zf2clientmoysklad_metadata_collection' => function () {
                    $directoryScanner = new DirectoryScanner(__DIR__.'/src/Zf2ClientMoysklad/Entity');

                    $annotationManager = new AnnotationManager();
                    $annotationManager->attach(new AnnotationParser());

                    $collector = new EntityCollector($annotationManager, $directoryScanner);
                    return new MetadataCollection($collector);
                },

                'zf2clientmoysklad_entity_manager' => function ($sm) {
                    $mapper = new GenericMapper($sm->get('zf2clientmoysklad_generic_transport'));
                    $metadataCollection = $sm->get('zf2clientmoysklad_metadata_collection');
                    return new EntityManager(new UnitOfWork($metadataCollection,
                                                            $mapper),
                                             $metadataCollection);
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