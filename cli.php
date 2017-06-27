#!/usr/bin/env php
<?php

require_once './vendor/autoload.php';

$isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');

// 若是 Windows系统, 使用 UTF-8 编码
($isWin) && system('chcp 65001');

//$process = GyTreasure\Process\DrawAllToday\DrawAllToday::forge('chongqing_ssc');

//$process->run();

$config = GyTreasure\Config::get('database.2011', []);
$medoo  = new Medoo\Medoo($config);
$model  = new GyTreasure\Frameworks\Framework2011\Models\LotteryModel($medoo);

// print_r($model->pdo());
