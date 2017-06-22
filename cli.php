#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

$client = \GyTreasure\Fetcher\Request::forge();

$data = $client->get('http://old.unreachable.com/Open/CurrentOpen?code=10011');

print_r(gettype($data));

// $res = $client->request('GET', 'http://old.1680210.com/Open/CurrentOpen?code=10011');
// $res = $client->request('GET', 'http://old.unreachable.com/Open/CurrentOpen?code=10011');
