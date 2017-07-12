<?php

namespace GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com;

use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException;

class DownloadTrendAwardNumber
{
    const API_PATH = 'downloadTrendAwardNumber.html';

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\FileRequest
     */
    protected $fileRequest;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\TrendXlsReader
     */
    protected $reader;

    /**
     * DownloadTrendAwardNumber constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\FileRequest     $fileRequest
     * @param \GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\TrendXlsReader  $reader
     */
    public function __construct(FileRequest $fileRequest, TrendXlsReader $reader)
    {
        $this->fileRequest = $fileRequest;
        $this->reader      = $reader;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(FileRequest::forge(), new TrendXlsReader());
    }

    /**
     * @param  string  $gameEn
     * @param  string  $beginPeriod
     * @param  string  $endPeriod
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException  无法解析 XLS 档案
     */
    public function call($gameEn, $beginPeriod, $endPeriod)
    {
        $query      = compact('gameEn', 'beginPeriod', 'endPeriod');
        $raw        = $this->fileRequest->call(static::API_PATH, $query);

        // 写入暂存档
        $tmpfname   = tempnam(sys_get_temp_dir(), 'trend_xls_');
        file_put_contents($tmpfname, $raw);

        $array = $this->reader->read($tmpfname);

        unlink($tmpfname);

        if ($array === null) {
            throw new ApiParseException('Failed to open or parse file.');
        }

        return $array;
    }
}
