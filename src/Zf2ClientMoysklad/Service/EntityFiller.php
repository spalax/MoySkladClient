<?php
namespace Zf2ClientMoysklad\Service;

use Zf2ClientMoysklad\Service\Collector\Metadata\CollectorInterface;
use Zf2ClientMoysklad\Service\Exception\RuntimeException;

class EntityFiller
{
    /**
     * @var CollectorInterface
     */
    protected $collector = null;

    /**
     * @var array
     */
    protected $metadata = null;

    public function __construct(CollectorInterface $collector)
    {
        $this->collector = $collector;
    }

    /**
     * @param string $entityName
     * @param \SimpleXMLElement $data
     */
    public function getEntity($entityName, \SimpleXMLElement $data)
    {
        if (is_null($this->metadata)) {
            $this->metadata = $this->collector->collect();
        }

        if (!array_key_exists($entityName, $this->metadata)) {
            throw new RuntimeException('Could not find entity');
        }

        $instance = new $entityName();
        foreach($this->metadata[$entityName]['properties'] as $property) {
            $instance->{$property['setter']}($property['extractor']($data));
        }

        return $instance;
    }
}