<?php
namespace Zf2ClientMoysklad\Code\Annotation;
use Zend\Code\Annotation\AnnotationInterface;
use Zf2ClientMoysklad\Annotation\Exception\InvalidAttributeValueException;

class OneToMany implements AnnotationInterface
{
    protected $targetEntity = '';

    protected $name = '';

    protected $container = 0;

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
            // This exception added because if name will contains nesting path
            // then if you will define something like element:child then when
            // serialization will run if you have few items they will be nested in each other.
            // If you have element and childA and childB inside element. After serialization
            // you will have element:childA:childB, so i think it is not good and transparent behaviour.
            // Better it is will be denied.
            if (strpos($matches['name'], ':') || strpos($matches['name'], '/')) {
                throw new InvalidAttributeValueException("OneToMany relation must not contain nested element");
            }
            $this->name = $matches['name'];
        }

        if (preg_match("/isContainer\s*?=\s*?[\"|\'](?P<container>[0|1]+?)[\"|\']/", $content, $matches)) {
            $this->container = intval($matches['container']);
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

    /**
     * @return boolean
     */
    public function isContainer()
    {
        return !!$this->container;
    }
}
