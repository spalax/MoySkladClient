<?php
namespace Zf2ClientMoysklad;

ini_set('display_errors', true);

chdir(__DIR__);

if (file_exists(__DIR__ . '/../../../autoload.php')) {
    $includePath = __DIR__ . '/../../../autoload.php';
} else {
    $includePath = __DIR__ . '/../vendor/autoload.php';
}


if (!(@include_once $includePath)) {
    throw new \RuntimeException('Error: vendor/autoload.php could not be found. Did you run php composer.phar install?');
}

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

$module = new Module();

$sm = new ServiceManager(new Config($module->getServiceConfig()));

$sm->setService('config', array(
    'zf2clientmoysklad' => array(
        'api_url' => 'https://online.moysklad.ru',
        'user_name' => 'admin@info_milsdev',
        'password' => '65e23de84c'
    )
));

global $sm;
