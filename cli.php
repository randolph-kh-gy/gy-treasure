#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

// use GyTreasure\ApiFacades\RemoteApi\Api1680210Com\DrawNumbers;

// $number = DrawNumbers::forge()->drawLatestGroupIssues('10002');

// print_r($number);

$process = GyTreasure\Process\DrawAllToday\DrawAllToday::forge('chongqing_ssc');

$process->run();
