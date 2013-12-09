<?php
namespace Zf2ClientMoysklad\Mapper;

use Zend\Http\Header\GenericHeader;
use Zend\Http\Headers;
use Zend\Http\Request;
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

    /**
     * @param string $collectionPath
     * @param \SimpleXMLElement $element
     * @return \SimpleXMLElement | null
     */
    public function save($collectionPath, \SimpleXMLElement $element)
    {
        $uri = new Http($collectionPath);

        $request = new Request();

        $request->setMethod('PUT');

        $headers = new Headers();
        $headers->addHeader(new GenericHeader('Content-Type', 'application/xml'));
        $request->setHeaders($headers);
        $request->setContent($element->asXML());

        $response = $this->transport->put($uri, $request);
        $body = $response->getBody();

        if ($response->isClientError() || empty($body)) {
            return null;
        }

        return new \SimpleXMLElement($body);
    }
}
