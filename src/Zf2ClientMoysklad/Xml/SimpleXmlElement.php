<?php
namespace Zf2ClientMoysklad\Xml;

class SimpleXmlElement extends \SimpleXMLElement
{
    /**
     * Add SimpleXMLElement code into a SimpleXMLElement
     * @param SimpleXMLElement $append
     */
    public function appendXMLElement(\SimpleXMLElement $append)
    {
        if (strlen(trim((string) $append)) == 0) {
            $xml = $this->addChild($append->getName());
            foreach($append->children() as $child) {
                $xml->appendXMLElement($child);
            }
        } else {
            $xml = $this->addChild($append->getName(), (string) $append);
        }

        foreach($append->attributes() as $n => $v) {
            $xml->addAttribute($n, $v);
        }
    }
}
