<?php
namespace Zf2ClientMoysklad\Entity;

/**
 * Good Folders entity
 *
 * @MS\Service(path="/exchange/rest/ms/xml/GoodFolder",
 *             collection="/exchange/rest/ms/xml/GoodFolder/list")
 * @MS\Entity(repositoryClass="Zf2ClientMoysklad\Repository\GoodFoldersRepository")
 * @MS\XML(rootElement="goodFolder")
 */
class GoodFolder implements EntityInterface
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
     * @var string
     *
     * @MS\Column(name="accountId")
     */
    protected $accountId;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():name")
     */
    protected $name;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():parentUuid")
     */
    protected $parentUuid;

    /**
     * @var string
     *
     * @MS\Column(name="externalcode")
     */
    protected $externalCode;

    /**
     * @var string
     *
     * @MS\Column(name="attributes():updated")
     */
    protected $updated;

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
}
