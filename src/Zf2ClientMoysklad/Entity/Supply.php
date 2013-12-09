<?php
namespace Zf2ClientMoysklad\Entity;
use Zf2ClientMoysklad\Entity\Supply\ShipmentIn;

/**
 * Supply entity
 *
 * @MS\Service(path="/exchange/rest/ms/xml/Supply",
 *             collection="/exchange/rest/ms/xml/Supply/list")
 * @MS\Entity(repositoryClass="Zf2ClientMoysklad\Repository\SupplyRepository")
 * @MS\XML(rootElement="supply")
 */
class Supply implements EntityInterface
{
    /**
     * @var string
     *
     * @MS\Id
     * @MS\Column(name="uuid")
     */
    protected $uuid;

    /**
     * @var \DateTime
     *
     * @MS\Column(name="attributes():created")
     */
    protected $created;

    /**
     * @var \DateTime
     *
     * @MS\Column(name="attributes():updated")
     */
    protected $updated;

    /**
     * @var \SplObjectStorage
     *
     * @MS\OneToMany(targetEntity="Zf2ClientMoysklad\Entity\Supply\ShipmentIn", name="shipmentIn")
     */
    protected $shipmentIn;

    public function __construct()
    {
        $this->shipmentIn = new \SplObjectStorage();
    }

    /**
     * @param ShipmentIn $shipmentIn
     */
    public function addShipmentIn(ShipmentIn $shipmentIn)
    {
        if (!$this->shipmentIn->contains($shipmentIn)) {
            $this->shipmentIn->attach($shipmentIn);
        }
    }

    /**
     * @return \SplObjectStorage
     */
    public function getShipmentIn()
    {
        return $this->shipmentIn;
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
