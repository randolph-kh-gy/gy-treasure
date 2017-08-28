<?php

namespace GyTreasure\Fetcher\RemoteApi\WwwPk10Me;

class ApiRequestRedirectionDecoder
{
    const HTML_START = '<html><body><script language="javascript">';
    const HTML_END   = '</script></body></html>';

    /**
     * @param  string  $response
     * @return bool
     */
    public function isDecodingNeeded($response)
    {
        return (bool) preg_match($this->pattern(), $response);
    }

    /**
     * @param  string  $response
     * @return string|null
     */
    public function decodeRedirection($response)
    {
        $code = $this->fetchJavaScript($response);
        if (! $code) {
            return null;
        }

        $url   = '';
        $lines = $this->splitLines($code);
        foreach ($lines as $line) {
            $this->decodeLine($line, $url);
        }

        return $url;
    }

    /**
     * @param  string  $response
     * @return string|null
     */
    protected function fetchJavaScript($response)
    {
        if (preg_match($this->pattern(), $response, $match)) {
            return $match[1];
        }
        return null;
    }

    /**
     * @param  string  $code
     * @return array
     */
    protected function splitLines($code)
    {
        return array_map('trim', explode(';', $code));
    }

    /**
     * @param  string  $line
     * @param  string  $url
     * @return bool
     */
    protected function decodeLine($line, &$url)
    {
        if (preg_match('/url\s*\=\s*\'([^\']*)\'\s*\+\s*url/', $line, $match)) {
            $url = $match[1] . $url;
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    protected function pattern()
    {
        return '/\s*' . preg_quote(static::HTML_START, '/') . '(.*)'
            . preg_quote(static::HTML_END, '/') . '\s*/i';
    }
}
