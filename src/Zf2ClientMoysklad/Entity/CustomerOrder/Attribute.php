<?php
namespace Zf2ClientMoysklad\Entity\CustomerOrder;

use Zf2ClientMoysklad\Entity\EntityInterface;

/**
 * Attribute position entity
 *
 * @MS\XML(rootElement="attribute")
 */
class Attribute implements EntityInterface
{
    /**
     * @var string
     *
     * @MS\Column(name="uuid", required="true")
     */
    protected $uuid;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():operationUuid")
     */
    protected $operationUuid;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():metadataUuid")
     */
    protected $metadataUuid;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():entityValueUuid")
     */
    protected $entityValueUuid;

    /**
     * @param string $operationUuid
     */
    public function setOperationUuid($operationUuid)
    {
        $this->operationUuid = $operationUuid;
    }

    /**
     * @return string
     */
    public function getOperationUuid()
    {
        return $this->operationUuid;
    }

    /**
     * @param string $entityValueUuid
     */
    public function setEntityValueUuid($entityValueUuid)
    {
        $this->entityValueUuid = $entityValueUuid;
    }

    /**
     * @return string
     */
    public function getEntityValueUuid()
    {
        return $this->entityValueUuid;
    }

    /**
     * @return string
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $metadataUuid
     */
    public function setMetadataUuid($metadataUuid)
    {
        $this->metadataUuid = $metadataUuid;
    }

    /**
     * @return string
     */
    public function getMetadataUuid()
    {
        return $this->metadataUuid;
    }
}
