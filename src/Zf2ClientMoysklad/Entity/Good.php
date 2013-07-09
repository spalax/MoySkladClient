<?php
namespace Zf2ClientMoysklad\Entity;

/**
 * Good entity
 *
 * @MS\Service(path="/exchange/rest/ms/xml/Good", collection="/exchange/rest/ms/xml/Good/list")
 * @MS\Entity(repositoryClass="Zf2ClientMoysklad\Repository\GoodsRepository")
 */
class Good implements EntityInterface
{
    /**
     * @var string
     *
     * @MS\Id
     * @MS\Column(name="uuid")
     */
    protected $uuid = '';

    /**
     * @var string
     *
     * @MS\Column(name="id")
     * @MS\Criteria
     */
    protected $id = '';

    /**
     * @var number
     *
     * @MS\Column(name="salePrices:price:attributes():value")
     */
    protected $price = 0;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():parentId")
     */
    protected $parentId = '';

    /**
     * @var string
     *
     * @MS\Column(name="attributes():updated")
     * @MS\Criteria
     */
    protected $updated = '';

    /**
     * @var string
     *
     * @MS\Column(name="attributes():updatedBy")
     * @MS\Criteria
     */
    protected $updatedBy = '';

    /**
     * @var string
     *
     * @MS\Column(name="attributes():parentUuid")
     */
    protected $parentUuid = '';

    /**
     * @var number
     *
     * @MS\Column(name="code")
     * @MS\Criteria
     */
    protected $code = 0;

    /**
     * @var string
     *
     * @MS\Column(name="accountId")
     */
    protected $accountId = '';

    /**
     * @var string
     *
     * @MS\Column(name="company")
     * @MS\Criteria
     */
    protected $company = '';

    /**
     * @var string
     *
     * @MS\Column(name="externalcode")
     * @MS\Criteria
     */
    protected $externalCode = '';

    /**
     * @var string
     *
     * @MS\Column(name="attributes():productCode")
     * @MS\Criteria
     */
    protected $productCode = '';

    /**
     * @var string
     *
     * @MS\Column(name="description")
     * @MS\Criteria
     */
    protected $description = '';

    /**
     * @var string
     *
     * @MS\Column(name="attributes():name")
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $article = 0;

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

    /**
     * @param string $updatedBy
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @return string
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param string $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param number $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return number
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
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
     * @param string $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return string
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param string $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * @return string
     */
    public function getArticle()
    {
        return $this->article;
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