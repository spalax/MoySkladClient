<?php
namespace Zf2ClientMoysklad\Entity;

use Zf2ClientMoysklad\Entity\PurchaseOrder\Position;

/**
 * Order entity
 *
 * @MS\Service(path="/exchange/rest/ms/xml/PurchaseOrder",
 *             collection="/exchange/rest/ms/xml/PurchaseOrder/list")
 * @MS\Entity(repositoryClass="Zf2ClientMoysklad\Repository\PurchaseOrderRepository")
 * @MS\XML(rootElement="purchaseOrder")
 */
class PurchaseOrder implements EntityInterface
{
    /**
     * @var string
     *
     * @MS\Id
     * @MS\Column(name="uuid")
     * @MS\Criteria
     */
    protected $uuid;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():name")
     */
    protected $name;

    /**
     * @var string
     *
     * @MS\Column(name="externalcode")
     * @MS\Criteria
     */
    protected $externalCode;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():sourceAgentUuid", required="true")
     */
    protected $sourceAgentUuid;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():targetAgentUuid", required="true")
     */
    protected $targetAgentUuid;

    /**
     * @var string
     *
     * @MS\Column(name="description")
     */
    protected $description;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():applicable", required="true")
     */
    protected $applicable = 'true';

    /**
     * @var \SplObjectStorage
     *
     * @MS\OneToMany(targetEntity="Zf2ClientMoysklad\Entity\PurchaseOrder\Position", name="purchaseOrderPosition")
     */
    protected $orderPosition;

    public function __construct()
    {
        $this->orderPosition = new \SplObjectStorage();
    }

    /**
     * @param Position $orderPosition
     */
    public function addOrderPosition(Position $orderPosition)
    {
        if (!$this->orderPosition->contains($orderPosition)) {
            $this->orderPosition->attach($orderPosition);
        }
    }

    /**
     * @param string $applicable
     */
    public function setApplicable($applicable)
    {
        $this->applicable = $applicable;
    }

    /**
     * @return string
     */
    public function getApplicable()
    {
        return $this->applicable;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $externalCode
     */
    public function setExternalCode($externalCode)
    {
        $this->externalCode = $externalCode;
    }

    /**
     * @return string
     */
    public function getExternalCode()
    {
        return $this->externalCode;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \SplObjectStorage $orderPosition
     */
    public function setOrderPosition(\SplObjectStorage $orderPosition)
    {
        $this->orderPosition = $orderPosition;
    }

    /**
     * @return \SplObjectStorage
     */
    public function getOrderPosition()
    {
        return $this->orderPosition;
    }

    /**
     * @param string $sourceAgentUuid
     */
    public function setSourceAgentUuid($sourceAgentUuid)
    {
        $this->sourceAgentUuid = $sourceAgentUuid;
    }

    /**
     * @return string
     */
    public function getSourceAgentUuid()
    {
        return $this->sourceAgentUuid;
    }

    /**
     * @param string $targetAgentUuid
     */
    public function setTargetAgentUuid($targetAgentUuid)
    {
        $this->targetAgentUuid = $targetAgentUuid;
    }

    /**
     * @return string
     */
    public function getTargetAgentUuid()
    {
        return $this->targetAgentUuid;
    }

    /**
     * @param string $uuid
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
}
