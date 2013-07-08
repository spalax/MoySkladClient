<?php
namespace Zf2ClientMoysklad\Mapper;

interface MapperInterface {
    /**
     * @param string $collectionPath
     * @return mixed
     */
    public function fetchAll($collectionPath);

    /**
     * @param string $collectionPath
     * @return mixed
     */
    public function fetchOne($collectionPath);
}