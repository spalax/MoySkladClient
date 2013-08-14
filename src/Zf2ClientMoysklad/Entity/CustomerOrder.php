<?php
namespace Zf2ClientMoysklad\Entity;

/**
 * Order entity
 *
 * @MS\Service(path="/exchange/rest/ms/xml/CustomerOrder",
 *             collection="/exchange/rest/ms/xml/CustomerOrder/list")
 * @MS\Entity(repositoryClass="Zf2ClientMoysklad\Repository\CustomerOrderRepository")
 * @MS\XML(rootElement="customerOrder")
 */
class CustomerOrder implements EntityInterface
{
    /**
     * @var string
     *
     * @MS\Column(name="id")
     * @MS\Criteria
     */
    protected $id;

    /**
     * @var string
     *
     * @MS\Id
     * @MS\Column(name="uuid")
     */
    protected $uuid;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():sourceStoreUuid", required="true")
     */
    protected $sourceStoreUuid;

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
    protected $applicable = 'false';

    /**
     * @var number
     *
     * @MS\Column(name="sum:attributes():sum")
     */
    protected $sum;

    /**
     * @var \SplObjectStorage
     *
     * @MS\OneToMany(targetEntity="Zf2ClientMoysklad\Entity\OrderPosition", name="customerOrderPosition")
     */
    protected $orderPosition;

    public function __construct()
    {
        $this->orderPosition = new \SplObjectStorage();
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param OrderPosition $orderPosition
     */
    public function addOrderPosition(OrderPosition $orderPosition)
    {
        if (!$this->orderPosition->contains($orderPosition)) {
            $this->orderPosition->attach($orderPosition);
        }
    }

    /**
     * @return \SplObjectStorage
     */
    public function getOrderPosition()
    {
        return $this->orderPosition;
    }

    /**
     * @param number $sum
     */
    public function setSum($sum)
    {
        $this->sum = $sum;
    }

    /**
     * @return number
     */
    public function getSum()
    {
        return $this->sum;
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
     * @param string $sourceStoreUuid
     */
    public function setSourceStoreUuid($sourceStoreUuid)
    {
        $this->sourceStoreUuid = $sourceStoreUuid;
    }

    /**
     * @return string
     */
    public function getSourceStoreUuid()
    {
        return $this->sourceStoreUuid;
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
     * @param string $applicable
     */
    public function setApplicable($applicable)
    {
        $this->applicable = ($applicable ? 'true' : 'false');
    }

    /**
     * @return string
     */
    public function getApplicable()
    {
        return $this->applicable;
    }
}