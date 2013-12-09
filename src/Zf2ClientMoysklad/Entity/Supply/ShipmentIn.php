<?php
namespace Zf2ClientMoysklad\Entity\Supply;
use Zf2ClientMoysklad\Entity\EntityInterface;

/**
 * ShipmentIn position entity
 *
 * @MS\XML(rootElement="shipmentIn")
 */
class ShipmentIn implements EntityInterface
{
    /**
     * @var string
     *
     * @MS\Id
     * @MS\Column(name="attributes():goodUuid", required="true")
     */
    protected $goodsUuid;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():goodId")
     */
    protected $goodsId;

    /**
     * @var number
     *
     * @MS\Column(name="attributes():quantity", required="true")
     */
    protected $quantity;

    /**
     * @var number
     *
     * @MS\Column(name="basePrice:attributes():sum", required="true")
     */
    protected $basePrice;

    /**
     * @var number
     *
     * @MS\Column(name="price:attributes():sum", required="true")
     */
    protected $price;

    /**
     * @param number $basePrice
     */
    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;
    }

    /**
     * @return number
     */
    public function getBasePrice()
    {
        return $this->basePrice;
    }

    /**
     * @param string $goodsId
     */
    public function setGoodsId($goodsId)
    {
        $this->goodsId = $goodsId;
    }

    /**
     * @return string
     */
    public function getGoodsId()
    {
        return $this->goodsId;
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
     * @param number $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return number
     */
    public function getPrice()
    {
        return $this->price;
    }
}

