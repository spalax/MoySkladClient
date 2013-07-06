<?php
namespace Zf2ClientMoysklad\Code\Annotation;
use Zend\Code\Annotation\AnnotationInterface;

class Id implements AnnotationInterface
{
    /**
     * Initialize
     *
     * @param  string $content
     */
    public function initialize($content)
    {
        \Zf2Libs\Debug\Utility::dump("CON", $content);
    }
}