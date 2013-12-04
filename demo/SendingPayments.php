<?php
namespace Zf2ClientMoysklad;

require_once __DIR__.'/_config.php';

use Zf2ClientMoysklad\Entity\CustomerOrder;
use Zf2ClientMoysklad\Entity\PaymentIn;
use Zf2ClientMoysklad\Repository\BasicRepository;

global $sm;

/* @var $entityManager EntityManager */
$entityManager = $sm->get('zf2clientmoysklad_entity_manager');

/*====================== Method for sending payments ==========================*/

/* @var $repository BasicRepository */
$repository = $entityManager->getRepository('Zf2ClientMoysklad\Entity\CustomerOrder');

/* @var $customerOrders CustomerOrder[] */
$customerOrders = $repository->findAll(array('externalCode = '=>array('P1fV-3Y3jhas7lnpZ_0ON0',
                                                                      'XXFSCoT7iAmnJIjeCHwqn0')));

foreach ($customerOrders as $orderEntity) {
    $paymentIn = new PaymentIn();

    $paymentIn->setCustomerOrderUuid($orderEntity->getUuid());
    $paymentIn->setSum($orderEntity->getSum());
    $paymentIn->setSumInCurrency($orderEntity->getSumInCurrency());
    $paymentIn->setSourceAgentUuid($orderEntity->getSourceAgentUuid());
    $paymentIn->setTargetAgentUuid($orderEntity->getTargetAgentUuid());
    $paymentIn->setDescription('Оплата через Робокассу');

    $entityManager->persist($paymentIn);
}

$entityManager->flush();

/*---------------------------------------------------------------------------------*/
