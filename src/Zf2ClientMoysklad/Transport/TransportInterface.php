<?php
namespace Zf2ClientMoysklad\Transport;

use Zend\Http\Response;
use Zend\Http\Request;
use Zend\Uri\Http;

interface TransportInterface
{
    /**
     * @param Http $uri
     * @return Response
     */
    public function get(Http $uri);
    /**
     * @param Http $uri
     * @return Response
     */
    public function post(Http $uri, Request $request);
    /**
     * @param Http $uri
     * @return Response
     */
    public function delete(Http $uri);
    /**
     * @param Http $uri
     * @return Response
     */
    public function put(Http $uri, Request $request);
}