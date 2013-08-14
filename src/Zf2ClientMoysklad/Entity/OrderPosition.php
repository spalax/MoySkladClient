<?php
namespace Zf2ClientMoysklad\Entity;

/**
 * Order position entity
 *
 * @MS\XML(rootElement="customerOrderPosition")
 */
class OrderPosition implements EntityInterface
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
     * @MS\Column(name="attributes():quantity")
     */
    protected $quantity;

    /**
     * @var number
     *
     * @MS\Column(name="basePrice:attributes():sum", required="true")
     */
    protected $basePrice = 0;

    /**
     * @var number
     *
     * @MS\Column(name="reserve")
     */
    protected $reserve;

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
     * @param number $reserve
     */
    public function setReserve($reserve)
    {
        $this->reserve = $reserve;
    }

    /**
     * @return string
     */
    public function getReserve()
    {
        return $this->reserve;
    }
}
