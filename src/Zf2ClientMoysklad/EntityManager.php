<?php
namespace Zf2ClientMoysklad;

use Composer\Autoload\ClassLoader;
use Zend\Code\Annotation\AnnotationManager;
use Zend\Loader\StandardAutoloader;
use Zf2ClientMoysklad\Entity\EntityInterface;
use Zf2ClientMoysklad\Code\Annotation;
use Zf2ClientMoysklad\Metadata\MetadataCollection;
use Zf2ClientMoysklad\Repository\BasicRepository;
use Zf2ClientMoysklad\Repository\RepositoryAbstract;

class EntityManager
{
    /**
     * @var UnitOfWork
     */
    protected $unitOfWork = null;

    protected $zendLoader = null;

    /**
     * @var MetadataCollection
     */
    protected $metadataCollection = null;

    public function __construct(UnitOfWork $unitOfWork, MetadataCollection $metadataCollection)
    {

        $this->zendLoader = new StandardAutoloader(array(
                  'namespaces' => array(
                         'Zf2ClientMoysklad' => __DIR__
                   )
        ));

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

        if (($className = $this->zendLoader->autoload($repository)) === false) {
            return new BasicRepository($entityName, $this->unitOfWork);
        }

        $className = '\\'.$className;
        return new $className($entityName, $this->unitOfWork);
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

    /**
     * @param EntityInterface $entity
     */
    public function persist(EntityInterface $entity)
    {
        $this->unitOfWork->persist($entity);
    }

    /**
     * @return void
     */
    public function flush()
    {
        $this->unitOfWork->commit();
    }
}