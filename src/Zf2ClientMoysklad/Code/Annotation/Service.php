<?php
namespace Zf2ClientMoysklad\Code\Annotation;
use Zend\Code\Annotation\AnnotationInterface;

class Service implements AnnotationInterface
{
    /**
     * @var string
     */
    protected $path = '';

    /**
     * @var string
     */
    protected $collectionPath = '';

    /**
     * Initialize
     *
     * @param string $content
     */
    public function initialize($content)
    {
        if (preg_match("/path\s*?=\s*?[\"|\'](?P<path>.+?)[\"|\']/", $content, $matches)) {
            $this->path = $matches['path'];
            $this->collectionPath = $matches['path'];
        }

        if (preg_match("/collection\s*?=\s*?[\"|\'](?P<path>.+?)[\"|\']/", $content, $matches)) {
            $this->collectionPath = $matches['path'];
        }
    }

    public function getCollectionPath()
    {
        return $this->collectionPath;
    }

    public function getPath()
    {
        return $this->path;
    }
}