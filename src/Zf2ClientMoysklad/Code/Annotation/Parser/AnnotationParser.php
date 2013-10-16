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
        $this->registerAnnotations(array('Zf2ClientMoysklad\\Code\\Annotation\\OneToMany'));
        $this->registerAnnotations(array('Zf2ClientMoysklad\\Code\\Annotation\\XML'));

        $this->setAlias('\\MS\\Id', 'Zf2ClientMoysklad\\Code\\Annotation\\Id');
        $this->setAlias('\\MS\\Column', 'Zf2ClientMoysklad\\Code\\Annotation\\Column');
        $this->setAlias('\\MS\\Service', 'Zf2ClientMoysklad\\Code\\Annotation\\Service');
        $this->setAlias('\\MS\\Entity', 'Zf2ClientMoysklad\\Code\\Annotation\\Entity');
        $this->setAlias('\\MS\\Criteria', 'Zf2ClientMoysklad\\Code\\Annotation\\Criteria');
        $this->setAlias('\\MS\\OneToMany', 'Zf2ClientMoysklad\\Code\\Annotation\\OneToMany');
        $this->setAlias('\\MS\\XML', 'Zf2ClientMoysklad\\Code\\Annotation\\XML');
    }

    /**
     * Normalize an alias name
     *
     * @param  string $alias
     * @return string
     */
    protected function normalizeAlias($alias)
    {
        $alias = substr($alias, strpos($alias, '\\MS'), strlen($alias));
        return parent::normalizeAlias($alias);
    }
}
