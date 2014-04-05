<?php
namespace Zf2ClientMoysklad;

require_once __DIR__.'/_config.php';

use Zf2ClientMoysklad\Entity\CustomerOrder;
use Zf2ClientMoysklad\Entity\Good;
use Zf2ClientMoysklad\Entity\PurchaseOrder;
use Zf2ClientMoysklad\Repository\BasicRepository;

global $sm;

/* @var $entityManager EntityManager */
$entityManager = $sm->get('zf2clientmoysklad_entity_manager');

/*====================== Method for sending payments ==========================*/

/* @var $repository BasicRepository */
$repository = $entityManager->getRepository('Zf2ClientMoysklad\Entity\CustomerOrder');

/* @var $customerOrders CustomerOrder[] */
$customerOrders = $repository->findAll(array('externalCode = '=>array('22684')));

foreach ($customerOrders as $orderEntity) {
    foreach ($orderEntity->getOrderPosition() as $orderPosition) {
        /* @var CustomerOrder\Position $orderPosition */
        $orderPosition->setQuantity(rand(1,9999));
    }
    $entityManager->persist($orderEntity);
}

$entityManager->flush();

/*---------------------------------------------------------------------------------*/
