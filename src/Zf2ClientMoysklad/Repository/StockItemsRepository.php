<?php

namespace Zf2ClientMoysklad\Repository;

use Zf2ClientMoysklad\Entity\EntityInterface;

class StockItemsRepository extends RepositoryAbstract
{
    /**
     * @return EntityInterface[]
     */
    public function findAll()
    {
        $persister = $this->unitOfWork->getEnityPersister($this->entityName);
        return $persister->loadAll(array(), null, 1);
    }
}