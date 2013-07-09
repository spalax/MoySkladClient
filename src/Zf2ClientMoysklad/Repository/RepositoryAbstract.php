<?php

namespace Zf2ClientMoysklad\Repository;

use Zf2ClientMoysklad\Entity\EntityInterface;
use Zf2ClientMoysklad\UnitOfWork;

abstract class RepositoryAbstract
{
    protected $entityName = null;
    protected $unitOfWork = null;

    public function __construct($entityName, UnitOfWork $unitOfWork)
    {
        $this->entityName = $entityName;
        $this->unitOfWork = $unitOfWork;
    }

    /**
     * @param $id
     * @return EntityInterface
     */
    public function find($id)
    {
        $persister = $this->unitOfWork->getEnityPersister($this->entityName);
        return $persister->load(array($id));
    }

    /**
     * @param array $criteria
     * @param int $offset
     * @param null | int $limit
     * @return EntityInterface[]
     */
    public function findAll(array $criteria = array(), $offset = 0, $limit = null)
    {
        $persister = $this->unitOfWork->getEnityPersister($this->entityName);
        return $persister->loadAll($criteria, $offset, $limit);
    }
}