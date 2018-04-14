<?php

namespace wbadrh\RestAPI;

use wbadrh\JSON_API\Response;

// http://route.thephpleague.com/
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


/**
 * ...
 */
class Controller
{
    // JSON response controller
    private $response;

    /**
     * JSON response controller
     */
    function __construct()
    {
        $this->response = new Response;
    }

    /**
     * ...
     *
     * @param ServerRequestInterface   $request  Zend Diactoros server request
     * @param ResponseInterface        $response PSR-7 HTTP response message
     * @return Zend\Diactoros\Response $response Manipulated PSR-7 HTTP response message
     */
    public function response(ServerRequestInterface $request, ResponseInterface $response)
    {
        // Throw Not Found
        //$this->response->exception(404);
        //print_r($this->reponse->exceptions());

        // Demo contents
        $contents = 'It works!';

        // PSR-7 JSON response
        return $this->response->dispatch($response, 200, $contents); // 202
    }

    /**
     * ...
     *
     * @param ServerRequestInterface   $request  Zend Diactoros server request
     * @param ResponseInterface        $response PSR-7 HTTP response message
     * @param Array                    $args     URL query parameters
     * @return Zend\Diactoros\Response $response Manipulated PSR-7 HTTP response message
     */
    public function response_args(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        // $requestBody = json_decode($request->getBody(), true);

        // Demo contents
        $contents = 'Hello, ' . $args['name'] . '!';

        // PSR-7 JSON response
        return $this->response->dispatch($response, 200, $contents); // 202
    }
}
