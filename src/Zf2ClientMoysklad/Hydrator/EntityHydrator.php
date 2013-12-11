<?php
namespace Zf2ClientMoysklad\Hydrator;

use Zf2ClientMoysklad\Entity\EntityInterface;
use Zf2ClientMoysklad\Metadata\ClassMetadata;
use Zf2ClientMoysklad\Xml\SimpleXmlElement;

class EntityHydrator
{
    /**
     * @var ClassMetadata
     */
    protected $metadata = null;

    public function __construct(ClassMetadata $metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     * @param EntityInterface $entity
     * @return \SimpleXMLElement
     * @throws Exception\RuntimeException
     */
    public function extract(EntityInterface $entity)
    {
        $rootElement = $this->metadata->getRootElement();
        $xmlElement = new SimpleXmlElement('<'.$rootElement.'></'.$rootElement.'>');

        foreach($this->metadata->getProperties() as $property) {
            $value = $entity->{$property->getGetter()}();
            $serializer = $property->getSerializer();

            if ($property->isOneToMany()) {
                $entityMetadata = $property->getTargetEntity();
                $hydrator = new EntityHydrator($entityMetadata);

                foreach ($value as $entity) {
                    $xmlEntry = $hydrator->extract($entity);
                    $serializer($xmlEntry, $xmlElement);

                    if (!$xmlEntry instanceof \SimpleXMLElement) {
                        throw new Exception\RuntimeException("XmlEntry does no SimpleXMLElement type,
                                                              invalid return type from Hydrator::extract");
                    }
                }
                continue;
            } else {
                $serializer($value, $xmlElement);
            }
        }

        return $xmlElement;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  EntityInterface $entity
     * @return object
     */
    public function hydrate(\SimpleXMLElement $data, EntityInterface $entity)
    {
        foreach($this->metadata->getProperties() as $property) {
            $extractor = $property->getExtractor();

            /* @var $extracted \SimpleXMLElement */
            $extracted = $extractor($data); // Get SimpleXMLElement from response XML tree.

            if ($property->isOneToMany()) {
                $splObjectStorage = $entity->{$property->getGetter()}();
                $splObjectStorage->removeAll($splObjectStorage);

                $entityMetadata = $property->getTargetEntity();
                $hydrator = new EntityHydrator($entityMetadata);

                $className = $entityMetadata->getName();

                if (!$extracted) {
                    throw new Exception\RuntimeException("Something gone wrong,
                                                         data could not be parsed ".$data->asXML());
                }

                foreach ($extracted as $xmlElement) {
                    $entity->{$property->getHandler()}($hydrator->hydrate($xmlElement,
                        new $className()));
                }
                continue;
            } else {
                if (empty($extracted)) continue;
                $entity->{$property->getHandler()}((string)$extracted);
            }
        }
        return $entity;
    }
}
