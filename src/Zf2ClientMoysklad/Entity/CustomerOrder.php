<?php
namespace Zf2ClientMoysklad\Entity;

use Zf2ClientMoysklad\Entity\CustomerOrder\Attribute;
use Zf2ClientMoysklad\Entity\CustomerOrder\Position;

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
     * @MS\Column(name="attributes():sourceStoreUuid")
     */
    protected $sourceStoreUuid;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():sourceAgentUuid")
     */
    protected $sourceAgentUuid;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():targetAgentUuid")
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
     * @MS\Column(name="attributes():applicable")
     */
    protected $applicable = 'false';

    /**
     * @var number
     *
     * @MS\Column(name="sum:attributes():sum")
     */
    protected $sum;

    /**
     * @var number
     *
     * @MS\Column(name="sum:attributes():sumInCurrency")
     */
    protected $sumInCurrency;

    /**
     * @var \SplObjectStorage
     *
     * @MS\OneToMany(targetEntity="Zf2ClientMoysklad\Entity\CustomerOrder\Position", name="customerOrderPosition")
     */
    protected $orderPosition;

    public function __construct()
    {
        $this->orderPosition = new \SplObjectStorage();
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
     * @param Position $orderPosition
     */
    public function addOrderPosition(Position $orderPosition)
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
     * @param number $sumInCurrency
     */
    public function setSumInCurrency($sumInCurrency)
    {
        $this->sumInCurrency = $sumInCurrency;
    }

    /**
     * @return number
     */
    public function getSumInCurrency()
    {
        return $this->sumInCurrency;
    }
}
