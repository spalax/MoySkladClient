<?php
namespace Zf2ClientMoysklad\Mapper;

use Zend\Uri\Http;
use Zf2ClientMoysklad\Options\ModuleOptionsInterface;
use Zf2ClientMoysklad\Transport\TransportInterface;

class GenericMapper implements MapperInterface
{
    /**
     * @var TransportInterface
     */
    protected $transport = null;

    /**
     * @param ModuleOptionsInterface $options
     */
    public function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @param string $collectionPath
     * @param null $limit
     * @return array
     */
    public function fetchAll($collectionPath)
    {
        $uri = new Http($collectionPath);

        $response = $this->transport->get($uri);
        $body = $response->getBody();

        if ($response->isClientError() || empty($body)) {
            return array();
        }

        return new \SimpleXMLIterator($body);
    }

    /**
     * @param string $collectionPath
     * @return \SimpleXMLElement | null
     */
    public function fetchOne($collectionPath)
    {
        $uri = new Http($collectionPath);

        $response = $this->transport->get($uri);
        $body = $response->getBody();

        if ($response->isClientError() || empty($body)) {
            return null;
        }

        return new \SimpleXMLElement($body);
    }
}