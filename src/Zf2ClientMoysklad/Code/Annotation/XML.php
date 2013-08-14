<?php
namespace Zf2ClientMoysklad\Code\Annotation;
use Zend\Code\Annotation\AnnotationInterface;

class XML implements AnnotationInterface
{
    /**
     * @var string
     */
    protected $rootElement = '';

    /**
     * Initialize
     *
     * @param string $content
     */
    public function initialize($content)
    {
        if (preg_match("/rootElement\s*?=\s*?[\"|\'](?P<rootElement>.+?)[\"|\']/", $content, $matches)) {
            $this->rootElement = $matches['rootElement'];
        }
    }

    /**
     * @return string
     */
    public function getRootElement()
    {
        return $this->rootElement;
    }
}