<?php

namespace GyTreasure\Fetcher\RemoteApi;

abstract class GBKHtmlRequest extends BaseHtmlRequest
{
    /**
     * @param  string  $response
     * @return string
     */
    protected function parseResponse($response)
    {
        return $this->convertGBK($response);
    }

    /**
     * 转换 GBK 编码.
     *
     * @param  string  $html
     * @return string
     */
    public function convertGBK($html)
    {
        $encoding = mb_detect_encoding($html, ['UTF-8', 'GBK']);

        if ($encoding == 'UTF-8') {
            return $html;
        } else {
            return mb_convert_encoding($html, 'UTF-8', 'GBK');
        }
    }
}
