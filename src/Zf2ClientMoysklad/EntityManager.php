<?php
namespace Zf2ClientMoysklad;

use Zend\Code\Annotation\AnnotationManager;
use Zf2ClientMoysklad\Entity\EntityInterface;
use Zf2ClientMoysklad\Code\Annotation;
use Zf2ClientMoysklad\Metadata\MetadataCollection;
use Zf2ClientMoysklad\Exception\RuntimeException;
use Zf2ClientMoysklad\Repository\RepositoryAbstract;

class EntityManager
{
    /**
     * @var UnitOfWork
     */
    protected $unitOfWork = null;

    /**
     * @var MetadataCollection
     */
    protected $metadataCollection = null;

    public function __construct(UnitOfWork $unitOfWork, MetadataCollection $metadataCollection)
    {
        $this->unitOfWork = $unitOfWork;
        $this->metadataCollection = $metadataCollection;
    }

    /**
     * Gets the repository for a class.
     *
     * @param string $entityName
     * @return RepositoryAbstract
     */
    public function getRepository($entityName)
    {
        $classMetadata = $this->metadataCollection->getClassMetadata($entityName);
        $repository = $classMetadata->getRepository();

        if (!class_exists($repository)) {
            throw new RuntimeException("Could not found repository class ".$repository);
        }

        return new $repository($entityName, $this->unitOfWork);
    }

    /**
     * @param string $entityName
     * @param mixed $id
     * @return null | EntityInterface
     * @throws \Zf2SimpleAcl\Options\Exception\InvalidArgumentException
     */
    public function find($entityName, $id)
    {
        $persister = $this->unitOfWork->getEnityPersister($entityName);
        return $persister->load(array($id));
    }
}