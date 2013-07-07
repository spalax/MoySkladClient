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
     * @param array $criteria
     * @param int $offset
     * @param int $limit
     * @return string
     * @throws Exception\InvalidArgumentException
     */
    protected function processCriteria(array $criteria, $offset = 0, $limit = 1000)
    {
        $suffix = array();
        foreach ($criteria as $criteriaKey => $criteriaValue) {
            if (!preg_match('/^(?P<field>.*?)(?P<cond>[=|\>=|\<=|\>|\<])$/', $criteriaKey, $matches)) {
                throw new InvalidArgumentException("Key of criteria must have a condition");
            }
            $suffix[] = $matches['field'].$matches['cond'].$criteriaValue;
        }

        $query = array();
        $result = 'list';
        if (count($suffix)) {
            $query[] = 'filter='.urlencode(join(';',$suffix));
        }

        $query['start'] = 'start='.$offset;
        $query['limit'] = 'count='.$limit;

        return $result.'?'.join("&", $query);
    }

    /**
     * @param array $criteria
     * @param number $offset [OPTIONAL]
     * @param number $limit [OPTIONAL]
     * @return EntityInterface | null
     */
    public function load(array $criteria, $offset = 0, $limit = 1000)
    {
        if (count($criteria) == 1) {
            list($key, $value) = each($criteria);
            if (is_numeric($key)) {
                $suffix = $value;
            } else {
                $suffix = $this->processCriteria($criteria, $offset, $limit);
            }
        } else {
            $suffix = $this->processCriteria($criteria, $offset, $limit);
        }

        $element = $this->mapper->fetchOne($this->classMetadata->getServiceUrl().'/'.$suffix);

        if (is_null($element)) {
            return null;
        }

        $entityName = $this->classMetadata->getName();
        $hydrator = new EntityHydrator($this->classMetadata);
        return $hydrator->hydrate($element, new $entityName());
    }

    /**
     * @param array $criteria
     * @param int $offset [OPTIONAL]
     * @param int $limit [OPTIONAL]
     * @return EntityInterface[]
     */
    public function loadAll(array $criteria, $offset = 0, $limit = 1000)
    {
        // TODO: Implement loadAll() method.
    }
}