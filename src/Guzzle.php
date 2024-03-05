<?php

namespace Alsharie\AlQutaibiBankPayment;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Guzzle
{
    /**
     * Store guzzle client instance.
     *
     * @var AlQutaibiBank
     */
    protected $guzzleClient;

    /**
     * AlQutaibiBank payment base path.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Store AlQutaibiBank payment endpoint.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * BaseService Constructor.
     */
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->guzzleClient = new Client();

        $this->basePath = config('AlQutaibiBank.url.base');
    }


    /**
     * @param $path
     * @param $attributes
     * @param $headers
     * @param array $security
     * @param string $method
     * @return ResponseInterface
     */
    protected function sendRequest($path, $attributes, $headers, $security = [], string $method = 'POST'): ResponseInterface
    {
        return $this->guzzleClient->request(
            $method,
            $path,
            [
                'headers' => [
                    ...$headers,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'x-channel' => 'merchant'
                ],
                'json' => $attributes,
                ...$security
            ]
        );
    }


    protected function getRequestPaymentPath(): string
    {
        return $this->basePath . '/' . "/E_Payment/RequestPayment";
    }

    protected function getConfirmPaymentPath(): string
    {
        return $this->basePath . '/' . "/E_Payment/ConfirmPayment";
    }


}