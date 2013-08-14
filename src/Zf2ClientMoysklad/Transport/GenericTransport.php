<?php
namespace Zf2ClientMoysklad\Transport;

use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Stdlib\DispatchableInterface;
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
     * @param Request $request
     * @return Response
     */
    protected function proceed(Http $httpUri, Request $request)
    {
        $httpUri = $httpUri->parse($this->moduleOptions->getApiUrl().$httpUri->toString());
        $request->setUri($httpUri);

        $this->httpClient->setAuth($this->moduleOptions->getUserName(),
                                   $this->moduleOptions->getPassword());

        $this->httpClient->setOptions(array('sslverifypeer'=>false));
        return $this->httpClient->send($request);
    }

    /**
     * @param Http $httpUri
     * @return Response
     */
    public function get(Http $uri)
    {
        $request = new Request();
        return $this->proceed($uri, $request);
    }

    /**
     * @param Http $uri
     * @param Request $request
     * @return Response
     */
    public function post(Http $uri, Request $request)
    {
        return $this->proceed($uri, $request);
    }

    public function delete(Http $uri)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param Http $uri
     * @param Request $request
     * @return Response
     */
    public function put(Http $uri, Request $request)
    {
        return $this->proceed($uri, $request);
    }
}