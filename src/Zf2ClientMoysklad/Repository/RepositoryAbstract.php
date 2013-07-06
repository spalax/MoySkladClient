<?php

namespace Zf2ClientMoysklad\Repository;

use Zf2ClientMoysklad\Entity\EntityInterface;
use Zf2ClientMoysklad\EntityManager;
use Zf2ClientMoysklad\Mapper\MapperInterface;

abstract class RepositoryAbstract
{
    protected $entity = null;
    protected $entityManager = null;
    protected $mapper = null;
    protected $annotations = array();

    public function __construct($entity, EntityManager $entityManager, MapperInterface $mapper, array $annotations)
    {
        $this->entity = $entity;
        $this->entityManager = $entityManager;
        $this->mapper = $mapper;
        $this->annotations = $annotations;
    }

    /**
     * @param $id
     * @return EntityInterface
     */
    public function find($id)
    {
        return $this->entityManager->find($this->entity, $id);
    }

    /**
     * @param int $offset
     * @param null $limit
     * @return null
     */
    public function findAll($offset = 0, $limit = null)
    {
        $elements = $this->mapper->fetchAll($this->annotations['url'].'/list', $offset, $limit);
        if (empty($elements)) {
            return array();
        }

        $instances = array();

        foreach ($elements as $element) {
            $instance = new $this->entity();
            foreach($this->annotations['properties'] as $property) {
                $instance->{$property['setter']}($property['extractor']($element));
            }
            $instances[] = $instance;
        }
        return $instances;
    }
}