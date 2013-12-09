<?php
namespace Zf2ClientMoysklad\Entity\PurchaseOrder;

use Zf2ClientMoysklad\Entity\EntityInterface;

/**
 * Purchase order position entity
 *
 * @MS\XML(rootElement="purchaseOrderPosition")
 */
class Position implements EntityInterface
{
    /**
     * @var string
     *
     * @MS\Id
     * @MS\Column(name="attributes():goodUuid", required="true")
     */
    protected $goodsUuid;

    /**
     * @var number
     *
     * @MS\Column(name="attributes():quantity", required="true")
     */
    protected $quantity;

    /**
     * @var number
     *
     * @MS\Column(name="attributes():discount")
     */
    protected $discount;

    /**
     * @var number
     *
     * @MS\Column(name="basePrice:attributes():sum", required="true")
     */
    protected $basePriceSum = 0;

    /**
     * @var number
     *
     * @MS\Column(name="basePrice:attributes():sumInCurrency")
     */
    protected $basePriceSumInCurrency = 0;

    /**
     * @var number
     *
     * @MS\Column(name="price:attributes():sum")
     */
    protected $priceSum = 0;

    /**
     * @var number
     *
     * @MS\Column(name="price:attributes():sumInCurrency")
     */
    protected $priceSumInCurrency = 0;

    /**
     * @var number
     *
     * @MS\Column(name="reserve")
     */
    protected $reserve;

    /**
     * @param number $basePriceSum
     */
    public function setBasePriceSum($basePriceSum)
    {
        $this->basePriceSum = $basePriceSum;
    }

    /**
     * @return number
     */
    public function getBasePriceSum()
    {
        return $this->basePriceSum;
    }

    /**
     * @param number $basePriceSumInCurrency
     */
    public function setBasePriceSumInCurrency($basePriceSumInCurrency)
    {
        $this->basePriceSumInCurrency = $basePriceSumInCurrency;
    }

    /**
     * @return number
     */
    public function getBasePriceSumInCurrency()
    {
        return $this->basePriceSumInCurrency;
    }

    /**
     * @param number $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return number
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param string $goodsUuid
     */
    public function setGoodsUuid($goodsUuid)
    {
        $this->goodsUuid = $goodsUuid;
    }

    /**
     * @return string
     */
    public function getGoodsUuid()
    {
        return $this->goodsUuid;
    }

    /**
     * @param number $priceSum
     */
    public function setPriceSum($priceSum)
    {
        $this->priceSum = $priceSum;
    }

    /**
     * @return number
     */
    public function getPriceSum()
    {
        return $this->priceSum;
    }

    /**
     * @param number $priceSumInCurrency
     */
    public function setPriceSumInCurrency($priceSumInCurrency)
    {
        $this->priceSumInCurrency = $priceSumInCurrency;
    }

    /**
     * @return number
     */
    public function getPriceSumInCurrency()
    {
        return $this->priceSumInCurrency;
    }

    /**
     * @param number $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return number
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param number $reserve
     */
    public function setReserve($reserve)
    {
        $this->reserve = $reserve;
    }

    /**
     * @return number
     */
    public function getReserve()
    {
        return $this->reserve;
    }
}
