<?php
namespace Zf2ClientMoysklad\Entity;

/**
 * Order entity
 *
 * @MS\Service(path="/exchange/rest/ms/xml/PaymentIn",
 *             collection="/exchange/rest/ms/xml/PaymentIn/list")
 * @MS\XML(rootElement="paymentIn")
 */
class PaymentIn implements EntityInterface
{
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
     * @MS\Column(name="attributes():name")
     */
    protected $name;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():vatIncluded", required="true")
     */
    protected $vatIncluded = 'true';

    /**
     * @var string
     *
     * @MS\Column(name="attributes():applicable", required="true")
     */
    protected $applicable = 'true';
    /**
     * @var string
     *
     * @MS\Column(name="attributes():payerVat", required="true")
     */
    protected $payerVat = 'true';

    /**
     * @var string
     *
     * @MS\Column(name="attributes():customerOrderUuid", required="true")
     */
    protected $customerOrderUuid;

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
     * @param string $customerOrderUuid
     */
    public function setCustomerOrderUuid($customerOrderUuid)
    {
        $this->customerOrderUuid = $customerOrderUuid;
    }

    /**
     * @return string
     */
    public function getCustomerOrderUuid()
    {
        return $this->customerOrderUuid;
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
     * @param string $payerVat
     */
    public function setPayerVat($payerVat)
    {
        $this->payerVat = $payerVat;
    }

    /**
     * @return string
     */
    public function getPayerVat()
    {
        return $this->payerVat;
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
     * @param string $vatIncluded
     */
    public function setVatIncluded($vatIncluded)
    {
        $this->vatIncluded = $vatIncluded;
    }

    /**
     * @return string
     */
    public function getVatIncluded()
    {
        return $this->vatIncluded;
    }
}
