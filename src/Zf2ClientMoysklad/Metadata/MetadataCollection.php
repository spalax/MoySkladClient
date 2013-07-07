<?php
namespace Zf2ClientMoysklad\Metadata;

use Zf2ClientMoysklad\Metadata\Collector\CollectorInterface;

class MetadataCollection implements \ArrayAccess
{
    /**
     * @var CollectorInterface
     */
    protected $collector = null;

    /**
     * @var null
     */
    protected $metadata = null;

    /**
     * @param CollectorInterface $collector
     */
    public function __construct(CollectorInterface $collector)
    {
        $this->collector = $collector;
    }

    protected function init()
    {
        if (is_null($this->metadata)) {
            foreach ($this->collector->collect() as $className => $metadataClass) {
                $this->metadata[$className] = new ClassMetadata($metadataClass);
            }
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        is_null($this->metadata) && $this->init();
        return array_key_exists($offset, $this->metadata);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        is_null($this->metadata) && $this->init();
        return $this->metadata[$offset];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        is_null($this->metadata) && $this->init();
        $this->metadata[$offset] = new ClassMetadata($value);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        is_null($this->metadata) && $this->init();
        unset($this->metadata[$offset]);
    }
}