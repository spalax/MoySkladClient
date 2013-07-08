<?php
namespace Zf2ClientMoysklad\Code\Annotation\Parser;

use Zend\Code\Annotation\Parser\GenericAnnotationParser;

class AnnotationParser extends GenericAnnotationParser
{
    public function __construct()
    {
        $this->registerAnnotations(array('Zf2ClientMoysklad\\Code\\Annotation\\Id'));
        $this->registerAnnotations(array('Zf2ClientMoysklad\\Code\\Annotation\\Column'));
        $this->registerAnnotations(array('Zf2ClientMoysklad\\Code\\Annotation\\Service'));
        $this->registerAnnotations(array('Zf2ClientMoysklad\\Code\\Annotation\\Entity'));
        $this->registerAnnotations(array('Zf2ClientMoysklad\\Code\\Annotation\\Criteria'));

        $this->setAlias('Zf2ClientMoysklad\\Entity\\MS\\Id', 'Zf2ClientMoysklad\\Code\\Annotation\\Id');
        $this->setAlias('Zf2ClientMoysklad\\Entity\\MS\\Column', 'Zf2ClientMoysklad\\Code\\Annotation\\Column');
        $this->setAlias('Zf2ClientMoysklad\\Entity\\MS\\Service', 'Zf2ClientMoysklad\\Code\\Annotation\\Service');
        $this->setAlias('Zf2ClientMoysklad\\Entity\\MS\\Entity', 'Zf2ClientMoysklad\\Code\\Annotation\\Entity');
        $this->setAlias('Zf2ClientMoysklad\\Entity\\MS\\Criteria', 'Zf2ClientMoysklad\\Code\\Annotation\\Criteria');
    }
}
