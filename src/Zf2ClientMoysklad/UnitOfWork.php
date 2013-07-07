<?php
/**
 * Created by JetBrains PhpStorm.
 * User: oleksiimilotskyi
 * Date: 7/7/13
 * Time: 10:50 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Zf2ClientMoysklad;

use Zf2ClientMoysklad\Exception\RuntimeException;
use Zf2ClientMoysklad\Mapper\MapperInterface;
use Zf2ClientMoysklad\Metadata\ClassMetadata;
use Zf2ClientMoysklad\Metadata\MetadataCollection;
use Zf2ClientMoysklad\Persister;

class UnitOfWork
{
    /**
     * @var array
     */
    protected $persisters = array();

    /**
     * @var ClassMetadata[]
     */
    protected $metadataCollection = null;

    /**
     * @var MapperInterface
     */
    protected $mapper = null;

    public function __construct(MetadataCollection $metadataCollection, MapperInterface $mapper)
    {
        $this->metadataCollection = $metadataCollection;
        $this->mapper = $mapper;
    }

    /**
     * @param string $entityName
     * @return Persister\PersisterInterface
     * @throws RuntimeException
     */
    public function getEnityPersister($entityName)
    {
        $persister = new Persister\BasicEntityPersister($this->mapper,
                                                        $this->metadataCollection[$entityName]);
        $this->persisters[$entityName] = $persister;
        return $persister;
    }
}