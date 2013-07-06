<?php
namespace Zf2ClientMoysklad\Code\Annotation;
use Zend\Code\Annotation\AnnotationInterface;

class Column implements AnnotationInterface
{
    protected $name = '';
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
    }

    public function getName()
    {
        return $this->name;
    }
}