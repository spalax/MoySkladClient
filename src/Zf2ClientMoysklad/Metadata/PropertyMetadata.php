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
     * @var string
     */
    protected $setter = '';

    /**
     * @var bool
     */
    protected $primary = false;

    /**
     * @var bool
     */
    protected $criteria = false;

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

        if (!array_key_exists('setter', $data)) {
            throw new InvalidArgumentException("Setter must present in property data");
        }
        $this->setSetter($data['setter']);

        if (!array_key_exists('extractor', $data) || !($data['extractor'] instanceof \Closure)) {
            throw new InvalidArgumentException("Extractor must present and callable in property data");
        }
        $this->setExtractor($data['extractor']);

        if (array_key_exists('primary', $data) && $data['primary'] === true) {
            $this->setPrimary(true);
        }

        if (array_key_exists('criteria', $data) && $data['criteria'] === true) {
            $this->setCriteria(true);
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
     * @param string $setter
     */
    public function setSetter($setter)
    {
        $this->setter = $setter;
    }

    /**
     * @return string
     */
    public function getSetter()
    {
        return $this->setter;
    }
}