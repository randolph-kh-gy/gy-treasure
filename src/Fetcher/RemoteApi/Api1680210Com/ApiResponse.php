<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com;

use ArrayAccess;

class ApiResponse implements ArrayAccess
{
    /**
     * @var string
     */
    protected $message = '';

    /**
     * @var array
     */
    protected $data = [];

    public function __construct($message, array $data)
    {
        $this->message = $message;
        $this->data    = $data;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param  mixed  $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param  mixed  $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * @param  $compares
     * @return bool
     */
    public function equals($compares)
    {
        return $this->message == $compares->message
            && $this->data == $compares->data;
    }
}