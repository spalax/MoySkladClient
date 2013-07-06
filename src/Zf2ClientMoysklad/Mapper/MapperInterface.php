<?php
namespace Zf2ClientMoysklad\Mapper;

interface MapperInterface {
    /**
     * @param string $collectionPath
     * @param number $offset
     * @param null|number $limit
     * @return mixed
     */
    public function fetchAll($collectionPath, $offset = 0, $limit = null);

    /**
     * @param string $collectionPath
     * @return mixed
     */
    public function fetchOne($collectionPath);
}