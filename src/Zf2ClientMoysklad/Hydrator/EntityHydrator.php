<?php
namespace Zf2ClientMoysklad\Hydrator;

use Zf2ClientMoysklad\Entity\EntityInterface;
use Zf2ClientMoysklad\Metadata\ClassMetadata;

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
            $entity->{$property->getSetter()}($extractor($data));
        }
        return $entity;
    }
}