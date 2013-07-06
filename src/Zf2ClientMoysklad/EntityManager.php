<?php
namespace Zf2ClientMoysklad;

use Zend\Code\Annotation\AnnotationManager;
use Zend\Code\Scanner\ClassScanner;
use Zf2ClientMoysklad\Code\Annotation\Parser\AnnotationParser;
use Zf2ClientMoysklad\Entity\EntityInterface;
use Zf2ClientMoysklad\Mapper\MapperInterface;
use \Zf2ClientMoysklad\Code\Annotation;
use Zf2SimpleAcl\Options\Exception\InvalidArgumentException;

class EntityManager
{
    /**
     * @var MapperInterface
     */
    protected $mapper = null;

    /**
     * @var ClassScanner[]
     */
    protected $classes = array();

    /**
     * @var AnnotationManager
     */
    protected $annotationManager = null;

    public function __construct(MapperInterface $mapper)
    {
        $this->annotationManager = new AnnotationManager();
        $this->annotationManager->attach(new AnnotationParser());

        $this->mapper = $mapper;
        $this->prepareMetadata();
    }

    /**
     * @param string $fieldName
     * @return callable
     */
    protected function getFieldExtractor($fieldName)
    {
        return function (\SimpleXMLElement $element) use ($fieldName) {
            $el = $element;
            $tokens = explode(':', $fieldName);
            foreach ($tokens as $token) {
                if ($token == 'attributes()') {
                    if (!method_exists($el, 'attributes')) {
                        return '';
                    }
                    $el = $el->attributes();
                } else {
                    $el = $el->{$token};
                }
            }
            return (string)$el;
        };
    }

    protected function prepareMetadata()
    {
        $scanner = new \Zend\Code\Scanner\DirectoryScanner(__DIR__.'/Entity');

        /* @var $class \Zend\Code\Scanner\ClassScanner */
        foreach ($scanner->getClasses() as $class) {
            if ($class->isInterface()) continue;

            $classArr = array('properties'=>array());

            foreach ($class->getAnnotations($this->annotationManager) as $annotation) {
                if ($annotation instanceof Annotation\Service) {
                    $classArr['url'] = $annotation->getPath();
                } else if ($annotation instanceof Annotation\Entity) {
                    $repository = $annotation->getRepository();
                    $classArr['repository'] = $repository;
                }
            }

            /* @var $property \Zend\Code\Scanner\PropertyScanner */
            foreach ($class->getProperties() as $property) {
                $propertyArr = array('field'=>'',
                                     'primary'=>false);

                $annotations = $property->getAnnotations($this->annotationManager);
                if (!$annotations->count()) continue;

                foreach($annotations as $annotation) {
                    if ($annotation instanceof Annotation\Id) {
                        $propertyArr['primary'] = true;
                    } else if ($annotation instanceof Annotation\Column) {
                        $propertyArr['field'] = $annotation->getName();
                        $propertyArr['extractor'] = $this->getFieldExtractor($annotation->getName());
                        foreach($class->getMethodNames() as $methodName) {
                            if (strpos(strtolower($methodName), strtolower($property->getName())) !== false) {
                                $propertyArr['setter'] = $methodName;
                                break;
                            }
                        }
                    }
                }

                $classArr['properties'][] = $propertyArr;
            }

            $this->classes[$class->getName()] = $classArr;
        }
    }

    /**
     * Gets the repository for a class.
     *
     * @param string $className
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository($entityName)
    {
        if (!array_key_exists($entityName, $this->classes)) {
            throw new InvalidArgumentException('Could not find entity');
        }

        if (!class_exists($this->classes[$entityName]['repository'])) {
            throw new InvalidArgumentException('Invalid repository class defined for Entity');
        }

        $className = $this->classes[$entityName]['repository'];
        return new $className($entityName, $this, $this->mapper, $this->classes[$entityName]);
    }

    /**
     * @param string $entityName
     * @param mixed $id
     * @return null | EntityInterface
     * @throws \Zf2SimpleAcl\Options\Exception\InvalidArgumentException
     */
    public function find($entityName, $id)
    {
        if (!array_key_exists($entityName, $this->classes)) {
            throw new InvalidArgumentException('Could not find entity');
        }

        $element = $this->mapper->fetchOne($this->classes[$entityName]['url'].'/'.$id);

        if (is_null($element)) {
            return null;
        }

        $instance = new $entityName();
        foreach($this->classes[$entityName]['properties'] as $property) {
            $instance->{$property['setter']}($property['extractor']($element));
        }
        return $instance;
    }
}