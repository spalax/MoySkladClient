<?php
namespace Zf2ClientMoysklad\Persister;

use Zf2ClientMoysklad\Entity\EntityInterface;

interface PersisterInterface
{
    /**
     * @param array $criteria
     * @return null | EntityInterface
     */
    public function load(array $criteria);

    /**
     * @param array $criteria [OPTIONAL]
     * @param int $offset [OPTIONAL]
     * @param int $limit [OPTIONAL]
     * @return EntityInterface[]
     */
    public function loadAll(array $criteria = array(), $offset = null, $limit = null);

    /**
     * @param EntityInterface $entity
     * @return mixed
     */
    public function save(EntityInterface $entity);
}