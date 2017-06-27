<?php

namespace GyTreasure;

class Console
{
    /**
     * @var resource
     */
    protected $stdout;

    /**
     * @var resource
     */
    protected $stderr;

    /**
     * @var static|null
     */
    protected static $instance;

    /**
     * Console constructor.
     */
    public function __construct()
    {
        $this->stdout = fopen('php://stdout', 'w');
        $this->stderr = fopen('php://stdout', 'w');
    }

    /**
     * @return static
     */
    public static function instance()
    {
        if (static::$instance === null)
        {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @return resource
     */
    public function stdout()
    {
        return $this->stdout;
    }

    /**
     * @return resource
     */
    public function stderr()
    {
        return $this->stderr;
    }

    /**
     * @param  string  $message
     * @return $this
     */
    public function write($message)
    {
        fwrite($this->stdout, $message);
        return $this;
    }

    /**
     * @param  string  $message
     * @return $this
     */
    public function writeln($message)
    {
        $this->write($message . PHP_EOL);
        return $this;
    }

    /**
     * @param  string  $message
     * @return $this
     */
    public function error($message)
    {
        fwrite($this->stderr, $message);
        return $this;
    }

    /**
     * @param  string  $message
     * @return $this
     */
    public function errorln($message)
    {
        $this->error($message . PHP_EOL);
        return $this;
    }

    public function __destruct()
    {
        fclose($this->stdout);
        fclose($this->stderr);
    }
}