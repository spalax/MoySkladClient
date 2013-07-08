<?php
namespace Zf2ClientMoysklad\Metadata;

use Zf2ClientMoysklad\Metadata\Exception\InvalidArgumentException;

class ClassMetadata
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $servicePath = '';

    /**
     * @var string
     */
    protected $serviceCollectionPath = '';

    /**
     * @var string
     */
    protected $repository = '';

    /**
     * @var PropertyMetadata[]
     */
    protected $properties = array();

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
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (!array_key_exists('name', $data)) {
            throw new InvalidArgumentException('Name must be present in data array');
        }
        $this->setName($data['name']);

        if (!array_key_exists('path', $data)) {
            throw new InvalidArgumentException('Service path must be present in data array');
        }
        $this->setServicePath($data['path']);

        if (array_key_exists('repository', $data)) {
            $this->setRepository($data['repository']);
        }

        if (array_key_exists('collectionPath', $data)) {
            $this->setServiceCollectionPath($data['collectionPath']);
        }

        if (!array_key_exists('properties', $data) || !is_array($data['properties'])) {
            throw new InvalidArgumentException('Properties must be present in data array');
        }

        foreach ($data['properties'] as $property) {
            $this->addProperty(new PropertyMetadata($property));
        }
    }

    /**
     * @param array $properties
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;
    }

    /**
     * @param PropertyMetadata $property
     */
    public function addProperty(PropertyMetadata $property)
    {
        array_push($this->properties, $property);
    }

    /**
     * @param string $name
     * @return null|PropertyMetadata
     */
    public function getProperty($name)
    {
        foreach ($this->properties as $property) {
            if ($property->getName() == $name) {
                return $property;
            }
        }
        return null;
    }

    /**
     * @return PropertyMetadata[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param string $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param string $serviceCollectionPath
     */
    public function setServiceCollectionPath($serviceCollectionPath)
    {
        $this->serviceCollectionPath = $serviceCollectionPath;
    }

    /**
     * @return string
     */
    public function getServiceCollectionPath()
    {
        return $this->serviceCollectionPath;
    }

    /**
     * @param string $servicePath
     */
    public function setServicePath($servicePath)
    {
        $this->servicePath = $servicePath;
    }

    /**
     * @return string
     */
    public function getServicePath()
    {
        return $this->servicePath;
    }
}