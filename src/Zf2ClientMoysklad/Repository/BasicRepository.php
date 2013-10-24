<?php

namespace Zf2ClientMoysklad\Repository;

class BasicRepository extends RepositoryAbstract
{
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