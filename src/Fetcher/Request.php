<?php

namespace GyTreasure\Fetcher;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Request
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public static function forge()
    {
        $client = new Client();
        return new static($client);
    }

    public function get($url)
    {
        return $this->_request('GET', $url);
    }

    protected function _request($method, $url)
    {
        try {
            $res = $this->client->request($method, $url);
            return $res->getBody();
        } catch (RequestException $e) {
            return null;
        }
    }
}