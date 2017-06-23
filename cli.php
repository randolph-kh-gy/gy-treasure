#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

// $result = GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCai::forge()->call('20170622059', 10002);
//$result = GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCaiList::forge()->call('10002');

// print_r($result);

//$result = GyTreasure\Fetcher\RemoteApi\Old1680210Com\Open\CurrentOpen::forge()->call('10011');
//
//print_r($result);

//$request = GyTreasure\Fetcher\RemoteApi\Caipiao163Com\ApiRequest::forge();
//
//$data = $request->call('award/getAwardNumberInfo.html', ['gameEn' => 'ssc', 'cache' => time(), 'periodNum' => 10]);
//
//print_r($data);

//$number = GyTreasure\ApiFacades\RemoteApi\Caipiao163Com\DrawNumber::forge()->fromIssueNumber('ssc', '170623025');
//
//print_r($number);

$number = GyTreasure\ApiFacades\RemoteApi\Caipiao163Com\DrawNumbers::forge()->drawLatestGroupIssues('ssc', 10);

print_r($number);
