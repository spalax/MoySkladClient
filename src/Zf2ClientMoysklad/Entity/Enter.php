<?php
namespace Zf2ClientMoysklad\Entity;
use Zf2ClientMoysklad\Entity\Enter\EnterPosition;

/**
 * Supply entity
 *
 * @MS\Service(path="/exchange/rest/ms/xml/Enter",
 *             collection="/exchange/rest/ms/xml/Enter/list")
 * @MS\Entity(repositoryClass="Zf2ClientMoysklad\Repository\EnterRepository")
 * @MS\XML(rootElement="enter")
 */
class Enter implements EntityInterface
{
    /**
     * @var string
     *
     * @MS\Id
     * @MS\Column(name="uuid")
     */
    protected $uuid = '';

    /**
     * @var \DateTime
     *
     * @MS\Column(name="attributes():created")
     */
    protected $created = null;

    /**
     * @var \DateTime
     *
     * @MS\Column(name="attributes():updated")
     */
    protected $updated = null;

    /**
     * @var \SplObjectStorage
     *
     * @MS\OneToMany(targetEntity="Zf2ClientMoysklad\Entity\Enter\EnterPosition", name="enterPosition")
     */
    protected $enterPosition;

    public function __construct()
    {
        $this->enterPosition = new \SplObjectStorage();
    }

    /**
     * @param EnterPosition $enterPosition
     */
    public function addEnterPosition(EnterPosition $enterPosition)
    {
        if (!$this->enterPosition->contains($enterPosition)) {
            $this->enterPosition->attach($enterPosition);
        }
    }

    /**
     * @return \SplObjectStorage
     */
    public function getEnterPosition()
    {
        return $this->enterPosition;
    }

    /**
     * @param string $created
     */
    public function setCreated($created)
    {
        $this->created = new \DateTime($created);
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = new \DateTime($updated);
    }

    /**
     * @return \DateTime
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