<?php
namespace Zf2ClientMoysklad\Transport;

use Zend\Http\Header\AcceptEncoding;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Stdlib\DispatchableInterface;
use Zend\Stdlib\ResponseInterface;
use Zend\Uri\Http;
use Zend\Http\Client;
use Zf2ClientMoysklad\Options\ModuleOptionsInterface;

class GenericTransport implements TransportInterface
{
    /**
     * @var Client
     */
    protected $httpClient = null;

    /**
     * @var ModuleOptionsInterface
     */
    protected $moduleOptions = null;

    /**
     * @param ModuleOptionsInterface $options
     * @param DispatchableInterface $dispatcher
     */
    public function __construct(ModuleOptionsInterface $options, Client $httpClient)
    {
        $this->moduleOptions = $options;
        $this->httpClient = $httpClient;
    }

    /**
     * @param Http $httpUri
     * @return Response
     */
    public function get(Http $httpUri)
    {

        $httpUri = $httpUri->parse($this->moduleOptions->getApiUrl().$httpUri->toString());

        $request = new Request();

        $request->setUri($httpUri);

        $this->httpClient->setAuth($this->moduleOptions->getUserName(),
                                   $this->moduleOptions->getPassword());

        $this->httpClient->setOptions(array('sslverifypeer'=>false));
        return $this->httpClient->send($request);
    }

    public function post(Http $uri)
    {
        // TODO: Implement post() method.
    }

    public function delete(Http $uri)
    {
        // TODO: Implement delete() method.
    }

    public function put(Http $uri)
    {
        // TODO: Implement put() method.
    }
}