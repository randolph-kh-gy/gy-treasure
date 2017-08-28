<?php

namespace GyTreasure\Fetcher\RemoteApi\SimpleJson;

abstract class SimpleAjaxJsonApiRequest extends SimpleJsonApiRequest
{
    /**
     * @param  string  $url
     * @return string|null
     */
    protected function request($url)
    {
        return $this->request->get($url, [
            'headers' => [
                'X-Requested-With' => 'XMLHttpRequest'
            ],
        ]);
    }
}
