<?php
namespace Zf2ClientMoysklad\Metadata;

use Zf2ClientMoysklad\Entity\EntityInterface;
use Zf2ClientMoysklad\Metadata\Collector\CollectorInterface;

class MetadataCollection
{
    /**
     * @var CollectorInterface
     */
    protected $collector = null;

    /**
     * @var null
     */
    protected $metadata = null;

    /**
     * @param CollectorInterface $collector
     */
    public function __construct(CollectorInterface $collector)
    {
        $this->collector = $collector;
    }

    protected function init()
    {
        if (is_null($this->metadata)) {
            foreach ($this->collector->collect() as $className => $metadataClass) {
                $this->metadata[$className] = new ClassMetadata($metadataClass);
            }
        }
    }

    /**
     * @param string $className
     * @return ClassMetadata
     * @throws \InvalidArgumentException
     */
    public function getClassMetadata($className)
    {
        is_null($this->metadata) && $this->init();
        if (!array_key_exists($className, $this->metadata)) {
            throw new \InvalidArgumentException("Could not found requested class name ".$className);
        }
        return $this->metadata[$className];
    }
}