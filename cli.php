#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

$result = GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\getBaseCQShiCai::call('20170622059', 10002);
//$result = GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\getBaseCQShiCaiList::call('10002');

print_r($result);