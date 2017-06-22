<?php

namespace GyTreasure\Fetcher;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Request
{
    protected $client;

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public static function forge()
    {
        $client = new Client();
        return new static($client);
    }

    /**
     * @param  string $url
     * @return \Psr\Http\Message\StreamInterface|null
     */
    public function get($url)
    {
        return $this->_request('GET', $url);
    }

    /**
     * @param  string $method
     * @param  string $url
     * @return \Psr\Http\Message\StreamInterface|null
     */
    protected function _request($method, $url)
    {
        try {
            $res = $this->client->request($method, $url);
            return (string) $res->getBody();
        } catch (RequestException $e) {
            return null;
        }
    }
}