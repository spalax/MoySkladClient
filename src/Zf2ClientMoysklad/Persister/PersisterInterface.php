<?php
namespace Zf2ClientMoysklad\Persister;

use Zf2ClientMoysklad\Entity\EntityInterface;

interface PersisterInterface
{
    /**
     * @param array $criteria
     * @param int $offset
     * @param int $limit
     * @return null | EntityInterface
     */
    public function load(array $criteria, $offset = 0, $limit = 1000);

    /**
     * @param array $criteria
     * @param int $offset
     * @param int $limit
     * @return EntityInterface[]
     */
    public function loadAll(array $criteria, $offset = 0, $limit = 1000);
}