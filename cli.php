#!/usr/bin/env php
<?php

require_once './vendor/autoload.php';

$isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');

// 若是 Windows系统, 使用 UTF-8 编码
($isWin) && system('chcp 65001');

// $data = (new GyTreasure\Drawer)->drawDay('chongqing_ssc', Carbon\Carbon::today());
// print_r($data);

// $data = (new GyTreasure\Drawer)->drawSingle('chongqing_ssc', '20170720-054', new Carbon\Carbon('2017-07-20'));
// print_r($data);

$drawer = new GyTreasure\Drawer();
$data = $drawer->drawDay('bjpk10', Carbon\Carbon::today());
print_r($data);
