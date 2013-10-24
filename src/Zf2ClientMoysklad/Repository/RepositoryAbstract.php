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
}