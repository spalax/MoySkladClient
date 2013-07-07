<?php
namespace Zf2ClientMoysklad;

use Zend\Code\Annotation\AnnotationManager;
use Zf2ClientMoysklad\Entity\EntityInterface;
use \Zf2ClientMoysklad\Code\Annotation;
use Zf2SimpleAcl\Options\Exception\InvalidArgumentException;

class EntityManager
{
    /**
     * @var null|UnitOfWork
     */
    protected $unitOfWork = null;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }

    /**
     * Gets the repository for a class.
     *
     * @param string $className
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository($entityName)
    {
        if (!array_key_exists($entityName, $this->classes)) {
            throw new InvalidArgumentException('Could not find entity');
        }

        if (!class_exists($this->classes[$entityName]['repository'])) {
            throw new InvalidArgumentException('Invalid repository class defined for Entity');
        }

        $className = $this->classes[$entityName]['repository'];
        return new $className($entityName, $this->mapper, $this->filler);
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