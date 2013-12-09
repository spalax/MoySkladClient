<?php
namespace Zf2ClientMoysklad\Entity;

/**
 * Company entity
 *
 * @MS\Service(path="/exchange/rest/ms/xml/Company",
 *             collection="/exchange/rest/ms/xml/Company/list")
 * @MS\Entity(repositoryClass="Zf2ClientMoysklad\Repository\CompanyRepository")
 * @MS\XML(rootElement="company")
 */
class Company implements EntityInterface
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
     * @MS\Criteria
     */
    protected $id;

    /**
     * @var number
     *
     * @MS\Column(name="attributes():name", required="true")
     */
    protected $name;

    /**
     * @var string
     *
     * @MS\Column(name="contact:attributes():address")
     */
    protected $address;

    /**
     * @var string
     *
     * @MS\Column(name="requisite:attributes():legalAddress")
     */
    protected $legalAddress;

    /**
     * @var string
     *
     * @MS\Column(name="requisite:attributes():actualAddress")
     */
    protected $actualAddress;

    /**
     * @var string
     *
     * @MS\Column(name="contact:attributes():phones")
     */
    protected $phones;

    /**
     * @var string
     *
     * @MS\Column(name="contact:attributes():faxes")
     */
    protected $faxes;

    /**
     * @var string
     *
     * @MS\Column(name="contact:attributes():mobiles")
     */
    protected $mobiles;

    /**
     * @var string
     *
     * @MS\Column(name="contact:attributes():email")
     */
    protected $email;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():companyType")
     */
    protected $companyType;

    /**
     * @var string
     *
     * @MS\Column(name="tags:tag")
     */
    protected $tagLabel;

    /**
     * @param string $tagLabel
     */
    public function setTagLabel($tagLabel)
    {
        $this->tagLabel = $tagLabel;
    }

    /**
     * @return string
     */
    public function getTagLabel()
    {
        return $this->tagLabel;
    }

    /**
     * @param string $companyType
     */
    public function setCompanyType($companyType)
    {
        $this->companyType = $companyType;
    }

    /**
     * @return string
     */
    public function getCompanyType()
    {
        return $this->companyType;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $faxes
     */
    public function setFaxes($faxes)
    {
        $this->faxes = $faxes;
    }

    /**
     * @return string
     */
    public function getFaxes()
    {
        return $this->faxes;
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
     * @param string $mobiles
     */
    public function setMobiles($mobiles)
    {
        $this->mobiles = $mobiles;
    }

    /**
     * @return string
     */
    public function getMobiles()
    {
        return $this->mobiles;
    }

    /**
     * @param number $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return number
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $phones
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;
    }

    /**
     * @return string
     */
    public function getPhones()
    {
        return $this->phones;
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
     * @param string $actualAddress
     */
    public function setActualAddress($actualAddress)
    {
        $this->actualAddress = $actualAddress;
    }

    /**
     * @return string
     */
    public function getActualAddress()
    {
        return $this->actualAddress;
    }

    /**
     * @param string $legalAddress
     */
    public function setLegalAddress($legalAddress)
    {
        $this->legalAddress = $legalAddress;
    }

    /**
     * @return string
     */
    public function getLegalAddress()
    {
        return $this->legalAddress;
    }
}
