<?php
namespace Zf2ClientMoysklad\Metadata\Collector;

use Zend\Code\Annotation\AnnotationManager;
use Zend\Code\Scanner\ClassScanner;
use Zend\Code\Scanner\PropertyScanner;
use Zf2ClientMoysklad\Code\Annotation;
use Zend\Code\Scanner\DirectoryScanner;
use Zf2ClientMoysklad\Metadata\Collector\Exception\RuntimeException;

class EntityCollector implements CollectorInterface
{
    /**
     * @var DirectoryScanner
     */
    protected $directoryScanner = null;

    /**
     * @var AnnotationManager
     */
    protected $annotationManager = null;

    /**
     * @var array
     */
    protected $classes = array();

    /**
     * @param string $pathToEntities
     */
    public function __construct(AnnotationManager $manager, DirectoryScanner $scanner)
    {
        $this->annotationManager = $manager;
        $this->directoryScanner = $scanner;
    }

    /**
     * @param ClassScanner $classScanner
     * @return array
     */
    protected function processClassAnnotations(ClassScanner $classScanner)
    {
        $result = array();
        $result['name'] = $classScanner->getName();
        foreach ($classScanner->getAnnotations($this->annotationManager) as $annotation) {
            if ($annotation instanceof Annotation\Service) {
                $result['url'] = $annotation->getPath();
            } else if ($annotation instanceof Annotation\Entity) {
                $result['repository'] = $annotation->getRepository();
            }
        }
        return $result;
    }

    /**
     * @param string $fieldName
     * @return callable
     */
    protected function buildFieldExtractor($fieldName)
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

    /**
     * @param ClassScanner $classScanner
     * @param PropertyScanner $propertyScanner
     * @return string
     */
    protected function detectPropertySetter(ClassScanner $classScanner, PropertyScanner $propertyScanner)
    {
        foreach($classScanner->getMethodNames() as $methodName) {
            if (strtolower($methodName) == strtolower('set'.$propertyScanner->getName())) {
                return $methodName;
            }
        }

        throw new RuntimeException("Could not found setter for property ".$propertyScanner->getName());
    }

    /**
     * @param ClassScanner $classScanner
     * @return array
     */
    protected function processPropertiesAnnotations(ClassScanner $classScanner)
    {
        $result = array();
        /* @var $propertyScanner \Zend\Code\Scanner\PropertyScanner */
        foreach ($classScanner->getProperties() as $propertyScanner) {
            $propertyArr = array();
            foreach($propertyScanner->getAnnotations($this->annotationManager) as $annotation) {
                if ($annotation instanceof Annotation\Column) {
                    $propertyArr['name'] = $propertyScanner->getName();
                    $propertyArr['field'] = $annotation->getName();
                    $propertyArr['extractor'] = $this->buildFieldExtractor($annotation->getName());
                    $propertyArr['setter'] = $this->detectPropertySetter($classScanner, $propertyScanner);
                } else if ($annotation instanceof Annotation\Id) {
                    $propertyArr['primary'] = true;
                }
            }

            if (!empty($propertyArr)) {
                $result['properties'][] = $propertyArr;
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    public function collect()
    {
        $classes = array();

        /* @var $classScanner \Zend\Code\Scanner\ClassScanner */
        foreach ($this->directoryScanner->getClasses() as $classScanner) {
            if ($classScanner->isInterface()) continue;

            $classArr = array('properties'=>array());

            $classArr = array_merge($classArr, $this->processClassAnnotations($classScanner));
            $classArr = array_merge($classArr, $this->processPropertiesAnnotations($classScanner));

            $classes[$classScanner->getName()] = $classArr;
        }

        return $classes;
    }
}