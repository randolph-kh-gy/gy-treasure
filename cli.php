#!/usr/bin/env php
<?php

require_once './vendor/autoload.php';

$isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');

// 若是 Windows系统, 使用 UTF-8 编码
($isWin) && system('chcp 65001');

$process = GyTreasure\Tasks\DrawDateTask::forge('chongqing_ssc');

$issues = (new GyTreasure\Issue\QuickIssue)->generate('chongqing_ssc', Carbon\Carbon::today(), 1, true);
$data = $process->run(Carbon\Carbon::today(), $issues);

print_r($data);
