<?php
namespace Zf2ClientMoysklad\Entity;

/**
 * Good entity
 *
 * @MS\Service(path="/exchange/rest/ms/xml/Good")
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
    protected $uuid;

    /**
     * @var string
     *
     * @MS\Column(name="id")
     */
    protected $id;

    /**
     * @var number
     *
     * @MS\Column(name="salePrices:price:attributes():value")
     */
    protected $price = 0;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():parentUuid")
     */
    protected $parentUuid = 0;

    /**
     * @var string
     *
     * @MS\Column(name="externalcode")
     */
    protected $externalCode = '';

    /**
     * @var string
     *
     * @MS\Column(name="description")
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
     *
     *
     */
    protected $article = 0;

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