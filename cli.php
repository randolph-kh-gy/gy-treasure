#!/usr/bin/env php
<?php

require_once './vendor/autoload.php';

$isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');

// 若是 Windows系统, 使用 UTF-8 编码
($isWin) && system('chcp 65001');

$process = GyTreasure\ApiFacades\RemoteApi\Www52kjwangCom\DrawNumbers::forge();

$data = $process->currentIssue('pk10');

print_r($data);

//$process = GyTreasure\ApiFacades\RemoteApi\Www52kjwangCom\DrawNumbers::forge();
//
//$data = $process->drawDateGroupIssues('pk10', Carbon\Carbon::today());
//
//print_r($data);
