<?php
namespace Zf2ClientMoysklad;

require_once __DIR__.'/_config.php';

use Zf2ClientMoysklad\Entity\Good;

global $sm;

/* @var $entityManager EntityManager */
$entityManager = $sm->get('zf2clientmoysklad_entity_manager');

/*====================== Method for sending payments ==========================*/


/* @var $goodEntity Good */
$goodEntity = $entityManager->find('Zf2ClientMoysklad\Entity\Good',
                                   'd606476e-5ccb-11e3-c096-7054d21a8d1e');



$entityManager->persist($goodEntity);
$goodEntity->setMinPrice(600000);
$goodEntity->setBuyPrice(888888);
$entityManager->flush();

/*---------------------------------------------------------------------------------*/
