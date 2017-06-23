#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

// $result = GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCai::call('20170622059', 10002);
//$result = GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCaiList::call('10002');

// print_r($result);

//$result = GyTreasure\Fetcher\RemoteApi\Old1680210Com\Open\CurrentOpen::call('10011');
//
//print_r($result);

$request = GyTreasure\Fetcher\RemoteApi\Caipiao163Com\ApiRequest::forge();

$data = $request->call('award/getAwardNumberInfo.html', ['gameEn' => 'ssc', 'cache' => time(), 'periodNum' => 10]);

print_r($data);
