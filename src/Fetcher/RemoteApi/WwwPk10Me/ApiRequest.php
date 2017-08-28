<?php

namespace GyTreasure\Fetcher\RemoteApi\WwwPk10Me;

use GyTreasure\Fetcher\Request;
use GyTreasure\Fetcher\RemoteApi\SimpleJson\SimpleAjaxJsonApiRequest;

class ApiRequest extends SimpleAjaxJsonApiRequest
{
    /**
     * @return static
     */
    public static function forge()
    {
        return new static(Request::forge());
    }

    /**
     * @return string
     */
    public function baseUrl()
    {
        return 'http://www.pk10.me/';
    }

    /**
     * @param  string  $url
     * @param  bool    $decode
     * @return string|null
     */
    protected function request($url, $decode = true)
    {
        return $this->decodeApiRedirection(parent::request($url));
    }

    /**
     * @param  string  $url
     * @return string|null
     */
    protected function requestWithoutApiRedirectionDecoding($url)
    {
        return parent::request($url);
    }

    /**
     * 针对 API 转址解码.
     *
     * @param  string  $html
     * @return string
     */
    protected function decodeApiRedirection($html)
    {
        $decoder        = new ApiRequestRedirectionDecoder;
        $redirection    = $decoder->decodeRedirection($html);

        if ($redirection) {
            $url        = $this->baseUrl() . ltrim($redirection, '/');
            $response   = $this->requestWithoutApiRedirectionDecoding($url);
            return $response;
        }

        return $html;
    }
}
