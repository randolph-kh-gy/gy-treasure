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

    /**
     * @return static
     */
    public static function forge()
    {
        $client = new Client();
        return new static($client);
    }

    /**
     * @param  string $url
     * @param  array  $options
     * @return string|null
     */
    public function get($url, array $options = [])
    {
        return $this->_request('GET', $url, $options);
    }

    /**
     * @param  string $method
     * @param  string $url
     * @param  array  $options
     * @return string|null
     */
    protected function _request($method, $url, array $options = [])
    {
        try {
            $res = $this->client->request($method, $url, $options);
            return (string) $res->getBody();
        } catch (RequestException $e) {
            return null;
        }
    }
}