<?php
namespace Zf2ClientMoysklad\Metadata;

use Zf2ClientMoysklad\Metadata\Exception\InvalidArgumentException;

class PropertyMetadata
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $field = '';

    /**
     * @var \Closure
     */
    protected $extractor = null;

    /**
     * @var \Closure
     */
    protected $serializer = null;

    /**
     * @var ClassMetadata
     */
    protected $targetEntity = null;

    /**
     * @var string
     */
    protected $handler = '';

    /**
     * @var string
     */
    protected $getter = '';

    /**
     * @var bool
     */
    protected $primary = false;

    /**
     * @var bool
     */
    protected $criteria = false;

    /**
     * @param string $getter
     */
    public function setGetter($getter)
    {
        $this->getter = $getter;
    }

    /**
     * @return string
     */
    public function getGetter()
    {
        return $this->getter;
    }

    /**
     * @param boolean $criteria
     */
    public function setCriteria($criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * @return boolean
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * @param boolean $primary
     */
    public function setPrimary($primary)
    {
        $this->primary = $primary;
    }

    /**
     * @return boolean
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (!array_key_exists('name', $data)) {
            throw new InvalidArgumentException("Name must present in property data");
        }
        $this->setName($data['name']);

        if (!array_key_exists('field', $data)) {
            throw new InvalidArgumentException("Field must present in property data");
        }
        $this->setField($data['field']);

        if (!array_key_exists('handler', $data)) {
            throw new InvalidArgumentException("Handler must present in property data");
        }
        $this->setHandler($data['handler']);

        if (!array_key_exists('getter', $data)) {
            throw new InvalidArgumentException("Getter must present in property data");
        }
        $this->setGetter($data['getter']);

        if (!array_key_exists('extractor', $data) || !($data['extractor'] instanceof \Closure)) {
            throw new InvalidArgumentException("Extractor must present and callable in property data");
        }
        $this->setExtractor($data['extractor']);

        if (!array_key_exists('serializer', $data) || !($data['serializer'] instanceof \Closure)) {
            throw new InvalidArgumentException("Serializer must present and callable in property data");
        }
        $this->setSerializer($data['serializer']);

        if (array_key_exists('primary', $data) && $data['primary'] === true) {
            $this->setPrimary(true);
        }

        if (array_key_exists('criteria', $data) && $data['criteria'] === true) {
            $this->setCriteria(true);
        }

        if (array_key_exists('targetEntity', $data) && $data['targetEntity'] instanceof ClassMetadata) {
            $this->setTargetEntity($data['targetEntity']);
        }
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \Closure $extractor
     */
    public function setExtractor(\Closure $extractor)
    {
        $this->extractor = $extractor;
    }

    /**
     * @return \Closure
     */
    public function getExtractor()
    {
        return $this->extractor;
    }

    /**
     * @param \Closure $serializer
     */
    public function setSerializer(\Closure $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return \Closure
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @param string $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param string $handler
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @return bool
     */
    public function isOneToMany()
    {
        return $this->targetEntity == null ? false : true ;
    }

    /**
     * @param ClassMetadata $targetEntity
     */
    public function setTargetEntity(ClassMetadata $targetEntity)
    {
        $this->targetEntity = $targetEntity;
    }

    /**
     * @return ClassMetadata
     */
    public function getTargetEntity()
    {
        return $this->targetEntity;
    }
}