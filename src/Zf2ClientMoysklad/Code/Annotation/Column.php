<?php
namespace Zf2ClientMoysklad\Code\Annotation;
use Zend\Code\Annotation\AnnotationInterface;

class Column implements AnnotationInterface
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var bool
     */
    protected $required = false;

    /**
     * Initialize
     *
     * @param string $content
     */
    public function initialize($content)
    {
        if (preg_match("/name\s*?=\s*?[\"|\'](?P<name>.+?)[\"|\']/", $content, $matches)) {
            $this->name = $matches['name'];
        }

        if (preg_match("/required\s*?=\s*?[\"|\'](?P<required>.+?)[\"|\']/", $content, $matches)) {
            $this->required = (boolean)$matches['required'];
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }
}