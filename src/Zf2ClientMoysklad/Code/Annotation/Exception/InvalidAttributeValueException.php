<?php
namespace Zf2ClientMoysklad\Annotation\Exception;

use Zf2ClientMoysklad\Exception\ExceptionInterface;

class InvalidAttributeValueException extends \Zend\Stdlib\Exception\InvalidArgumentException
    implements ExceptionInterface {}
