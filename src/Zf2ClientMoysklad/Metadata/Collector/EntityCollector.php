<?php
namespace Zf2ClientMoysklad\Metadata\Collector;

use Zend\Code\Annotation\AnnotationManager;
use Zend\Code\Scanner\ClassScanner;
use Zend\Code\Scanner\PropertyScanner;
use Zf2ClientMoysklad\Code\Annotation;
use Zend\Code\Scanner\DirectoryScanner;
use Zf2ClientMoysklad\Metadata\ClassMetadata;
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
                $result['path'] = $annotation->getPath();
                $result['collectionPath'] = $annotation->getCollectionPath();
            } else if ($annotation instanceof Annotation\Entity) {
                $result['repository'] = $annotation->getRepository();
            } else if ($annotation instanceof Annotation\XML) {
                $result['rootElement'] = $annotation->getRootElement();
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
                    if (!isset($el->{$token})) {
                        return '';
                    }
                    $el = $el->{$token};
                }
            }
            return $el;
        };
    }

    /**
     * @param string $fieldName
     * @param boolean $isRequired [OPTIONAL default = false]
     * @param boolean $isContainer [OPTIONAL default = false] is serializing fieldName has to contain all element as children
     * @return callable
     */
    protected function buildFieldSerializer($fieldName, $isRequired = false, $isContainer = false)
    {
        return function ($value, \SimpleXMLElement $element) use ($fieldName, $isRequired, $isContainer) {
            if (is_null($value)){
              if (!$isRequired) {
                  return $element;
              } else {
                  throw new Exception\RuntimeException($fieldName.' required to fill it on. It is must not be null.');
              }
            }

            $tokens = explode(':', $fieldName);
            $el = $element;

            foreach ($tokens as $i=>$token) {
                if ($token == 'attributes()') {
                    $el->addAttribute($tokens[count($tokens)-1], $value);
                    break;
                } else {
                    // Iteration over the children
                    // already created element.
                    foreach ($el->children() as $child) {
                        if ($child->getName() == $token) {
                            $el = $child;
                            if ((count($tokens)-1) == $i) {
                                // This construction should work with [element:attribute():attr]
                                if (!$value instanceof \SimpleXMLElement) {
                                    $el[0] = $value;
                                } else { // This construction should work when you have element
                                    // who is container and you populate it with children.
                                    $el = $el->appendXMLElement($value);
                                }
                            }
                            continue(2);
                        }
                    }

                    // Check whether cycle pointed to the last token
                    // from tokens. If path [a:b:c], it is check if current
                    // token is [c].
                    if (((count($tokens)-1) == $i)) {
                        if (!$value instanceof \SimpleXMLElement) {
                            $el = $el->addChild($token, $value);
                        } else {
                            if ($isContainer) {
                                $el = $el->addChild($token);
                            }
                            $el = $el->appendXMLElement($value);
                        }
                    } else {
                        // Add child if it is middle of the elements path
                        $el = $el->addChild($token);
                    }

                }
            }
            return $element;
        };
    }

    /**
     * @param ClassScanner $classScanner
     * @param PropertyScanner $propertyScanner
     * @return string
     */
    protected function detectPropertyGet(ClassScanner $classScanner, PropertyScanner $propertyScanner)
    {
        foreach($classScanner->getMethodNames() as $methodName) {
            if (strtolower($methodName) == strtolower('get'.$propertyScanner->getName())) {
                return $methodName;
            }
        }

        throw new RuntimeException("Could not found get for property ".$propertyScanner->getName());
    }

    /**
     * @param ClassScanner $classScanner
     * @param PropertyScanner $propertyScanner
     * @return string
     */
    protected function detectPropertySet(ClassScanner $classScanner, PropertyScanner $propertyScanner)
    {
        foreach($classScanner->getMethodNames() as $methodName) {
            if (strtolower($methodName) == strtolower('set'.$propertyScanner->getName())) {
                return $methodName;
            }
        }

        throw new RuntimeException("Could not found set for property ".$propertyScanner->getName());
    }

    /**
     * @param ClassScanner $classScanner
     * @param PropertyScanner $propertyScanner
     * @return string
     */
    protected function detectPropertyAdd(ClassScanner $classScanner, PropertyScanner $propertyScanner)
    {
        foreach($classScanner->getMethodNames() as $methodName) {
            if (strtolower($methodName) == strtolower('add'.$propertyScanner->getName())) {
                return $methodName;
            }
        }

        throw new RuntimeException("Could not found add handler for property ".$propertyScanner->getName());
    }

    /**
     * @param ClassScanner $classScanner
     * @param ClassScanner[] $allClassScanners
     * @return array
     */
    protected function processPropertiesAnnotations(ClassScanner $classScanner, array $allClassScanners)
    {
        $result = array();
        /* @var $propertyScanner \Zend\Code\Scanner\PropertyScanner */
        foreach ($classScanner->getProperties() as $propertyScanner) {
            $propertyArr = array();
            foreach($propertyScanner->getAnnotations($this->annotationManager) as $annotation) {
                if ($annotation instanceof Annotation\Column) {
                    $propertyArr = array_merge($propertyArr, $this->handleColumn($annotation,
                                                                                 $propertyScanner,
                                                                                 $classScanner));
                } else if ($annotation instanceof Annotation\Id) {
                    $propertyArr['primary'] = true;
                } else if ($annotation instanceof Annotation\Criteria) {
                    $propertyArr['criteria'] = true;
                } else if ($annotation instanceof Annotation\OneToMany) {
                    $propertyArr = array_merge($propertyArr,
                                               $this->handleOneToManyAnnotation($annotation,
                                                                                $propertyScanner,
                                                                                $classScanner,
                                                                                $allClassScanners));
                }
            }

            if (!empty($propertyArr)) {
                $result['properties'][] = $propertyArr;
            }
        }

        return $result;
    }

    /**
     * @param Annotation\Column $annotation
     * @param PropertyScanner $propertyScanner
     * @param ClassScanner $classScanner
     * @return array
     */
    protected function handleColumn(Annotation\Column $annotation,
                                    PropertyScanner $propertyScanner,
                                    ClassScanner $classScanner)
    {
        $propertyArr = array();

        $propertyArr['name'] = $propertyScanner->getName();
        $propertyArr['field'] = $annotation->getName();
        $propertyArr['extractor'] = $this->buildFieldExtractor($annotation->getName());
        $propertyArr['serializer'] = $this->buildFieldSerializer($annotation->getName(), $annotation->isRequired());
        $propertyArr['handler'] = $this->detectPropertySet($classScanner, $propertyScanner);
        $propertyArr['getter'] = $this->detectPropertyGet($classScanner, $propertyScanner);

        return $propertyArr;
    }

    /**
     * @param Annotation\OneToMany $annotation
     * @param PropertyScanner $propertyScanner
     * @param ClassScanner $classScanner
     * @param ClassScanner[] $allClassScanners
     * @return array
     * @throws Exception\RuntimeException
     */
    protected function handleOneToManyAnnotation(Annotation\OneToMany $annotation,
                                                 PropertyScanner $propertyScanner,
                                                 ClassScanner $classScanner,
                                                 array $allClassScanners)
    {
        $targetEntity = $annotation->getTargetEntity();
        $propertyArr = array();

        $propertyArr['name'] = $propertyScanner->getName();
        $propertyArr['field'] = $annotation->getName();
        $propertyArr['extractor'] = $this->buildFieldExtractor($annotation->getName());
        $propertyArr['serializer'] = $this->buildFieldSerializer($annotation->getName(),
                                                                 false, $annotation->isContainer());
        $propertyArr['handler'] = $this->detectPropertyAdd($classScanner, $propertyScanner);
        $propertyArr['getter'] = $this->detectPropertyGet($classScanner, $propertyScanner);

        $ref = new \ReflectionClass($classScanner->getName());
        if (!$ref->newInstance()->{$propertyArr['getter']}() instanceof \SplObjectStorage) {
            throw new RuntimeException("Invalid data type returned from getter in OneToMany relationship,
                                        must return SplObjectStorage");
        }

        /* @var $scanner ClassScanner  */
        foreach ($allClassScanners as $scanner) {
            if ($scanner->getName() == $targetEntity) {
                if (!($params = $this->collectDataForClass($scanner, $allClassScanners))) {
                    throw new RuntimeException("Invalid data type for collectDataForClass");
                }
                $propertyArr['targetEntity'] = new ClassMetadata($params);
                return $propertyArr;
            }
        }

        throw new RuntimeException("Invalid targetEntity this Entity could not be found by entity scanner");
    }

    /**
     * @param ClassScanner $classScanner
     * @param ClassScanner[] $allClasses
     * @return array | false
     */
    protected function collectDataForClass(ClassScanner $classScanner, array $allClasses)
    {
        if ($classScanner->isInterface() || $classScanner->isAbstract()) return false;

        $classArr = array('properties'=>array());

        $classArr = array_merge($classArr, $this->processClassAnnotations($classScanner));
        return array_merge($classArr, $this->processPropertiesAnnotations($classScanner, $allClasses));
    }

    /**
     * @return array
     */
    public function collect()
    {
        $classes = array();

        /* @var $classesToScan ClassScanner[] */
        $classesToScan = $this->directoryScanner->getClasses();

        /* @var $classScanner \Zend\Code\Scanner\ClassScanner */
        foreach ($classesToScan as $classScanner) {
            if (!($classArr = $this->collectDataForClass($classScanner, $classesToScan))) {
                continue;
            }

            $classes[$classScanner->getName()] = $classArr;
        }

        return $classes;
    }
}
