<?php
namespace Zf2ClientMoysklad\Entity;

/**
 * StockItem entity
 *
 * @MS\Service(path="/exchange/rest/stock/xml")
 * @MS\Entity(repositoryClass="Zf2ClientMoysklad\Repository\StockItemsRepository")
 */
class StockItem implements EntityInterface
{
    /**
     * @var string
     *
     * @MS\Column(name="attributes():productCode")
     */
    protected $productCode;

    /**
     * @var int
     *
     * @MS\Column(name="attributes():quantity")
     */
    protected $quantity;

    /**
     * @var int
     *
     * @MS\Column(name="attributes():stock")
     */
    protected $stock;

    /**
     * @var int
     *
     * @MS\Column(name="attributes():reserve")
     */
    protected $reserve;

    /**
     * @var number
     *
     * @MS\Column(name="attributes():sumTotal")
     */
    protected $sumTotal;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():salePrice")
     */
    protected $salePrice;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():category")
     */
    protected $category;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():externalCode")
     */
    protected $externalCode;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():parentUuid")
     */
    protected $parentUuid;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():parentId")
     */
    protected $parentId;

    /**
     * @var string
     *
     * @MS\Column(name="goodRef:attributes():id")
     */
    protected $goodId;

    /**
     * @var string
     *
     * @MS\Column(name="goodRef:attributes():uuid")
     */
    protected $goodUuid;

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
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
     * @param string $goodId
     */
    public function setGoodId($goodId)
    {
        $this->goodId = $goodId;
    }

    /**
     * @return string
     */
    public function getGoodId()
    {
        return $this->goodId;
    }

    /**
     * @param string $goodUuid
     */
    public function setGoodUuid($goodUuid)
    {
        $this->goodUuid = $goodUuid;
    }

    /**
     * @return string
     */
    public function getGoodUuid()
    {
        return $this->goodUuid;
    }

    /**
     * @param string $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @return string
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param string $parentUuid
     */
    public function setParentUuid($parentUuid)
    {
        $this->parentUuid = $parentUuid;
    }

    /**
     * @return string
     */
    public function getParentUuid()
    {
        return $this->parentUuid;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $reserve
     */
    public function setReserve($reserve)
    {
        $this->reserve = $reserve;
    }

    /**
     * @return int
     */
    public function getReserve()
    {
        return $this->reserve;
    }

    /**
     * @param string $salePrice
     */
    public function setSalePrice($salePrice)
    {
        $this->salePrice = $salePrice;
    }

    /**
     * @return string
     */
    public function getSalePrice()
    {
        return $this->salePrice;
    }

    /**
     * @param int $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param number $sumTotal
     */
    public function setSumTotal($sumTotal)
    {
        $this->sumTotal = $sumTotal;
    }

    /**
     * @return number
     */
    public function getSumTotal()
    {
        return $this->sumTotal;
    }

    /**
     * @param string $productCode
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
    }

    /**
     * @return string
     */
    public function getProductCode()
    {
        return $this->productCode;
    }
}
