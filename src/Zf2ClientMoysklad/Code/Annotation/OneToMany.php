<?php
namespace Zf2ClientMoysklad\Code\Annotation;
use Zend\Code\Annotation\AnnotationInterface;

class OneToMany implements AnnotationInterface
{
    protected $targetEntity = '';

    protected $name = '';

    /**
     * Initialize
     *
     * @param string $content
     */
    public function initialize($content)
    {
        if (preg_match("/targetEntity\s*?=\s*?[\"|\'](?P<targetEntity>.+?)[\"|\']/", $content, $matches)) {
            $this->targetEntity = $matches['targetEntity'];
        }

        if (preg_match("/name\s*?=\s*?[\"|\'](?P<name>.+?)[\"|\']/", $content, $matches)) {
            $this->name = $matches['name'];
        }
    }

    /**
     * @return string
     */
    public function getTargetEntity()
    {
        return $this->targetEntity;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}