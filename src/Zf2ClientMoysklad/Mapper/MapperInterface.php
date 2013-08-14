<?php
namespace Zf2ClientMoysklad\Mapper;

interface MapperInterface
{
    /**
     * @param string $collectionPath
     * @return mixed
     */
    public function fetchAll($collectionPath);

    /**
     * @param string $collectionPath
     * @return \SimpleXMLElement | null
     */
    public function fetchOne($collectionPath);

    /**
     * @param $collectionPath
     * @param \SimpleXMLElement $element
     * @return \SimpleXMLElement | null
     */
    public function save($collectionPath,
                         \SimpleXMLElement $element);
}