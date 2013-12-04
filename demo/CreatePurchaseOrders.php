<?php
namespace Zf2ClientMoysklad;

require_once __DIR__.'/_config.php';

use Zf2ClientMoysklad\Entity\Good;
use Zf2ClientMoysklad\Entity\PurchaseOrder;
use Zf2ClientMoysklad\Repository\BasicRepository;

global $sm;

/* @var $entityManager EntityManager */
$entityManager = $sm->get('zf2clientmoysklad_entity_manager');

/*====================== Method for Create purchase orders ==========================*/

$entityToOrder = '1e474a24-5cd7-11e3-00e2-7054d21a8d1e';

/* @var $goodEntity Good  */
$goodEntity = $entityManager->find('Zf2ClientMoysklad\Entity\Good', $entityToOrder);

$purchaseOrder = new PurchaseOrder();
$purchaseOrderPosition = new PurchaseOrder\Position();

$entityManager->persist($purchaseOrder);

//Dealer id
$purchaseOrder->setSourceAgentUuid('2678f502-5cc9-11e3-320b-7054d21a8d1e');

//Your organisation id
$purchaseOrder->setTargetAgentUuid('266ce37b-5cc9-11e3-92f6-7054d21a8d1e');

$purchaseOrderPosition->setGoodsUuid($goodEntity->getUuid());
$purchaseOrderPosition->setPriceSum($goodEntity->getPrice());
$purchaseOrderPosition->setPriceSumInCurrency($goodEntity->getPrice());
$purchaseOrderPosition->setQuantity(1000);
$purchaseOrderPosition->setReserve(10);

$purchaseOrder->addOrderPosition($purchaseOrderPosition);

$entityManager->flush();

/*---------------------------------------------------------------------------------*/
