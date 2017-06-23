#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use GyTreasure\ApiFacades\RemoteApi\Caipiao163Com\DrawNumbers;

$number = DrawNumbers::forge()->currentIssue('ssc');

print_r($number);
