<?php
/**
 * Created by JetBrains PhpStorm.
 * User: oleksiimilotskyi
 * Date: 7/7/13
 * Time: 11:09 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Zf2ClientMoysklad\Persister;


use Zend\Uri\Http;
use Zf2ClientMoysklad\Entity\EntityInterface;
use Zf2ClientMoysklad\Hydrator\EntityHydrator;
use Zf2ClientMoysklad\Mapper\MapperInterface;
use Zf2ClientMoysklad\Metadata\ClassMetadata;
use Zf2ClientMoysklad\Persister\Exception\InvalidArgumentException;

class BasicEntityPersister implements PersisterInterface
{
    /**
     * @var MapperInterface
     */
    protected $mapper = null;

    /**
     * @var array|null
     */
    protected $classMetadata = null;

    /**
     * @param MapperInterface $mapper
     * @param ClassMetadata $classMetadata
     */
    public function __construct(MapperInterface $mapper, ClassMetadata $classMetadata)
    {
        $this->mapper = $mapper;
        $this->classMetadata = $classMetadata;
    }

    /**
     * Processing criteria value or array
     * of values, it is very useful to find
     * by OR condition in remote Storage (MS)
     *
     * @param string $field
     * @param string $cond
     * @param mixed $value
     *
     * @return array
     */
    protected function processCriteriaValue($field, $cond, $value)
    {
        $result = array();
        if (is_array($value) || $value instanceof \Traversable) {
            foreach ($value as $v) {
                $result[] = $field.$cond.$v;
            }
        } else {
            $result[] = $field.$cond.$value;
        }
        return $result;
    }

    /**
     * Not all criterias could be added to the
     * filtration, please consult with defined
     * link bellow, to the understand which filtration options
     * could be used.
     *
     * @param array $criteria
     * @return Http
     * @link http://wiki.moysklad.ru/wiki/%D0%A4%D0%B8%D0%BB%D1%8C%D1%82%D1%80%D0%B0%D1%86%D0%B8%D1%8F_%D0%B4%D0%B0%D0%BD%D0%BD%D1%8B%D1%85_%D0%B2_REST-%D1%81%D0%B5%D1%80%D0%B2%D0%B8%D1%81%D0%B5
     * @throws Exception\InvalidArgumentException
     */
    protected function processCriteria(array $criteria)
    {
        $suffix = array();

        foreach ($criteria as $criteriaKey => $criteriaValue) {

            $criteriaKey = preg_replace('/\s/', '', $criteriaKey);
            if (!preg_match('/^(?P<field>.*?)(?P<cond>(=|>=|<=|>|<))$/', $criteriaKey, $matches)) {
                throw new InvalidArgumentException("Key of criteria must have a condition");
            }

            $property = $this->classMetadata->getProperty($matches['field']);

            if (!$property || !$property->getCriteria()) {
                throw new InvalidArgumentException("Criteria not found, or not supported for API");
            }

            $suffix = array_merge($suffix,
                                  $this->processCriteriaValue($matches['field'],
                                                              $matches['cond'],
                                                              $criteriaValue));
        }

        $query = array();
        if (count($suffix)) {
            $query['filter'] = join(';',$suffix);
        }


        $uri = new Http($this->classMetadata->getServiceCollectionPath());
        $uri->setQuery($query);

        return $uri;
    }

    /**
     * @param array $criteria
     * @return EntityInterface | null
     */
    public function load(array $criteria)
    {
        $httpUri = null;
        if (count($criteria) == 1) {
            list($key, $value) = each($criteria);
            if (is_numeric($key)) {
                $httpUri = new Http($this->classMetadata->getServicePath().'/'.$value);
            } else {
                $httpUri = $this->processCriteria($criteria);
            }
        } else {
            $httpUri = $this->processCriteria($criteria);
        }

        $element = $this->mapper->fetchOne($httpUri->toString());

        if (is_null($element)) {
            return null;
        }

        $entityName = $this->classMetadata->getName();
        $hydrator = new EntityHydrator($this->classMetadata);
        return $hydrator->hydrate($element, new $entityName());
    }

    /**
     * @param Http $httpUri
     * @param int $offset
     * @param int $limit
     * @return array
     */
    protected function partiallyRequest(Http $httpUri, $offset, $limit)
    {
        $query = $httpUri->getQueryAsArray();
        $query['start'] = $offset;
        $query['count'] = $limit;
        $httpUri->setQuery($query);
        $elements = $this->mapper->fetchAll($httpUri->toString());
        $entityName = $this->classMetadata->getName();

        $entities = array();

        foreach ($elements as $element) {
            $hydrator = new EntityHydrator($this->classMetadata);
            $entities[] = $hydrator->hydrate($element, new $entityName());
        }

        return $entities;
    }

    /**
     * @param EntityInterface $entity
     * @return mixed | object
     */
    public function save(EntityInterface $entity)
    {
        $httpUri = new Http($this->classMetadata->getServicePath());

        $hydrator = new EntityHydrator($this->classMetadata);
        $element = $this->mapper->save($httpUri, $hydrator->extract($entity));

        return $hydrator->hydrate($element, $entity);
    }

    /**
     * @param array $criteria [OPTIONAL]
     * @param int $offset [OPTIONAL]
     * @param int $limit [OPTIONAL]
     * @return EntityInterface[]
     */
    public function loadAll(array $criteria = array(), $offset = null, $limit = null)
    {
        $httpUri = $this->processCriteria($criteria);
        $entities = array();

        $offset = is_null($offset) ? 0 : $offset;

        if ($limit > 0) {
            $delta = intval($limit / 1000);
            $lastLimit = $limit % 1000;

            for ($i = 1;$i <= $delta; $i++) {
                $result = $this->partiallyRequest($httpUri, $offset, 1000);

                if (!count($result)) {
                    return $entities;
                }

                $entities = array_merge($entities, $result);
                $offset+= 1000;
            }

            if ($lastLimit) {
               $entities = array_merge($entities, $this->partiallyRequest($httpUri, $offset, $lastLimit));
            }
        } else if (is_null($limit)) {
            for ($offset = 0 ;; $offset+=1000) {
                $result = $this->partiallyRequest($httpUri, $offset, 1000);

                if (!count($result)) {
                    return $entities;
                }

                $entities = array_merge($entities, $result);
                if (count($result) < 1000) {
                    return $entities;
                }
            }
        }

        return $entities;
    }
}
