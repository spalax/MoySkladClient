<?php
/**
 * Created by JetBrains PhpStorm.
 * User: oleksiimilotskyi
 * Date: 7/7/13
 * Time: 10:50 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Zf2ClientMoysklad;

use Zend\Stdlib\Hydrator\Reflection;
use Zf2ClientMoysklad\Entity\EntityInterface;
use Zf2ClientMoysklad\Exception\RuntimeException;
use Zf2ClientMoysklad\Mapper\MapperInterface;
use Zf2ClientMoysklad\Metadata\ClassMetadata;
use Zf2ClientMoysklad\Metadata\MetadataCollection;
use Zf2ClientMoysklad\Persister;

class UnitOfWork
{
    const PERSISTED_NEW = 'new';
    const PERSISTED_OLD = 'old';

    /**
     * @var array
     */
    protected $persisters = array();

    /**
     * @var ClassMetadata[]
     */
    protected $metadataCollection = null;

    /**
     * @var array
     */
    protected $persisted = array();

    /**
     * @var MapperInterface
     */
    protected $mapper = null;

    public function __construct(MetadataCollection $metadataCollection, MapperInterface $mapper)
    {
        $this->metadataCollection = $metadataCollection;
        $this->mapper = $mapper;
        $this->persisted = array();
    }

    /**
     * @param string $entityName
     * @return Persister\PersisterInterface
     * @throws RuntimeException
     */
    public function getEnityPersister($entityName)
    {
        if (!array_key_exists($entityName, $this->persisters)) {
            $persister = new Persister\BasicEntityPersister($this->mapper,
                                                            $this->metadataCollection
                                                                 ->getClassMetadata($entityName));

            $this->persisters[$entityName] = $persister;
        }

        return $this->persisters[$entityName];
    }

    /**
     * @param EntityInterface $entity
     */
    public function persist(EntityInterface $entity)
    {
        $key = spl_object_hash($entity);
        $this->persisted[$key] = $entity;
    }

    public function commit()
    {
        foreach ($this->persisted as $k=>$entity) {
            $reflection = new \ReflectionObject($entity);
            $persister = $this->getEnityPersister($reflection->getName());
            $persister->save($entity);

            unset($this->persisted[$k]);
        }
    }
}