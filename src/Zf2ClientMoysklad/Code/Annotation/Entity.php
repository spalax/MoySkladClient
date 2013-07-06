<?php
namespace Zf2ClientMoysklad\Code\Annotation;
use Zend\Code\Annotation\AnnotationInterface;

class Entity implements AnnotationInterface
{
    protected $repository = '';

    /**
     * Initialize
     *
     * @param string $content
     */
    public function initialize($content)
    {
        if (preg_match("/repositoryClass\s*?=\s*?[\"|\'](?P<repositoryClass>.+?)[\"|\']/", $content, $matches)) {
            $this->repository = $matches['repositoryClass'];
        }
    }

    public function getRepository()
    {
        return $this->repository;
    }
}