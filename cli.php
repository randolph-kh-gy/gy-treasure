#!/usr/bin/env php
<?php

require_once './vendor/autoload.php';

$isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');

// 若是 Windows系统, 使用 UTF-8 编码
($isWin) && system('chcp 65001');

$process = GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\Pk10\Kj::forge();

$data = $process->call('2017-08-17');

print_r($data);
