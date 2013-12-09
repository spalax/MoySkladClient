<?php
namespace Zf2ClientMoysklad\Entity\Good;

use Zf2ClientMoysklad\Entity\EntityInterface;

/**
 * Price entity
 *
 * @MS\XML(rootElement="price")
 */
class Price implements EntityInterface
{
    /**
     * @var string
     * @MS\Id
     * @MS\Column(name="attributes():priceTypeUuid", required="true")
     */
    protected $typeUuid;

    /**
     * @var string
     *
     * @MS\Column(name="uuid")
     */
    protected $uuid;

    /**
     * @var number
     *
     * @MS\Column(name="attributes():value", required="true")
     */
    protected $value;

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
     * @param number $typeUuid
     */
    public function setTypeUuid($typeUuid)
    {
        $this->typeUuid = $typeUuid;
    }

    /**
     * @return number
     */
    public function getTypeUuid()
    {
        return $this->typeUuid;
    }

    /**
     * @param number $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return number
     */
    public function getValue()
    {
        return $this->value;
    }
}
