<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions;

class ApiErrorException extends ApiException
{
    /**
     * @var mixed 回应
     */
    protected $response;

    /**
     * ApiErrorException constructor.
     * @param string $message
     * @param int    $code
     * @param mixed  $response
     */
    public function __construct($message, $code, $response)
    {
        parent::__construct($message, $code);

        $this->response = $response;
    }

    /**
     * 取得回应
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}