<?php
namespace Zf2ClientMoysklad\Code\Annotation;
use Zend\Code\Annotation\AnnotationInterface;

class Service implements AnnotationInterface
{
    protected $path = '';

    /**
     * Initialize
     *
     * @param string $content
     */
    public function initialize($content)
    {
        if (preg_match("/path\s*?=\s*?[\"|\'](?P<path>.+?)[\"|\']/", $content, $matches)) {
            $this->path = $matches['path'];
        }
    }

    public function getPath()
    {
        return $this->path;
    }
}