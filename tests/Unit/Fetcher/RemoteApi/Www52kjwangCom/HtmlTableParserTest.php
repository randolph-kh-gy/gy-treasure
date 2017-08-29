<?php

namespace Tests\Unit\Fetcher\RemoteApi\Www52kjwangCom\Pk10;

use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\HtmlTableParser;

class HtmlTableParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $expects = [
            [
                'winningNumbers' => ['7', '10', '8', '1', '2', '9', '6', '3', '5', '4'],
                'issue' => '636912',
            ],
            [
                'winningNumbers' => ['9', '5', '8', '7', '2', '6', '1', '3', '10', '4'],
                'issue' => '636911',
            ],
            [
                'winningNumbers' => ['7', '9', '8', '3', '4', '2', '6', '1', '5', '10'],
                'issue' => '636910',
            ],
        ];

        $parser = new \GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\HtmlTableParser();
        $data   = $parser->parse($this->_html());

        $this->assertEquals($expects, $data);
    }

    private function _html()
    {
        return '<div class="kj52_bj_ExcelFile">
    <div id="history-table" class="kj52_lotteryTable">
        <table id="history">
            <tr class="LT-tr">
                <th style="width: 164px;">时间</th>
                <th style="width: 373px;">开奖号码</th>
                <th colspan="3">冠亚军和</th>
                <th colspan="5">1~5龍虎</th>
            </tr>

                <tr class=\'even\'>
                    <td style="width: 164px">
                        636912 08-29 14:22
                    </td>
                    <td style="width: 373px">
                        <div class="num_pk10">
                                <span class=\'no7\'></span>                
                                <span class=\'no10\'></span>                
                                <span class=\'no8\'></span>                
                                <span class=\'no1\'></span>                
                                <span class=\'no2\'></span>                
                                <span class=\'no9\'></span>                
                                <span class=\'no6\'></span>                
                                <span class=\'no3\'></span>                
                                <span class=\'no5\'></span>                
                                <span class=\'no4\'></span>                
                        </div>
                    </td>
                    <td style="width: 60px">17
                    </td>
                    <td style="width: 60px">
                        大
                    </td>
                    <td style="width: 60px">
                        单
                    </td>
                        <td style="width: 60px" class=\'kj52_bj_RedColor\'>
                            龍
                        </td>
                        <td style="width: 60px" class=\'kj52_bj_RedColor\'>
                            龍
                        </td>
                        <td style="width: 60px" class=\'kj52_bj_RedColor\'>
                            龍
                        </td>
                        <td style="width: 60px" class=\'\'>
                            虎
                        </td>
                        <td style="width: 60px" class=\'\'>
                            虎
                        </td>

                </tr>
                <tr class=\'odd\'>
                    <td style="width: 164px">
                        636911 08-29 14:17
                    </td>
                    <td style="width: 373px">
                        <div class="num_pk10">
                                <span class=\'no9\'></span>                
                                <span class=\'no5\'></span>                
                                <span class=\'no8\'></span>                
                                <span class=\'no7\'></span>                
                                <span class=\'no2\'></span>                
                                <span class=\'no6\'></span>                
                                <span class=\'no1\'></span>                
                                <span class=\'no3\'></span>                
                                <span class=\'no10\'></span>                
                                <span class=\'no4\'></span>                
                        </div>
                    </td>
                    <td style="width: 60px">14
                    </td>
                    <td style="width: 60px">
                        大
                    </td>
                    <td style="width: 60px">
                        双
                    </td>
                        <td style="width: 60px" class=\'kj52_bj_RedColor\'>
                            龍
                        </td>
                        <td style="width: 60px" class=\'\'>
                            虎
                        </td>
                        <td style="width: 60px" class=\'kj52_bj_RedColor\'>
                            龍
                        </td>
                        <td style="width: 60px" class=\'kj52_bj_RedColor\'>
                            龍
                        </td>
                        <td style="width: 60px" class=\'\'>
                            虎
                        </td>

                </tr>
                <tr class=\'even\'>
                    <td style="width: 164px">
                        636910 08-29 14:12
                    </td>
                    <td style="width: 373px">
                        <div class="num_pk10">
                                <span class=\'no7\'></span>                
                                <span class=\'no9\'></span>                
                                <span class=\'no8\'></span>                
                                <span class=\'no3\'></span>                
                                <span class=\'no4\'></span>                
                                <span class=\'no2\'></span>                
                                <span class=\'no6\'></span>                
                                <span class=\'no1\'></span>                
                                <span class=\'no5\'></span>                
                                <span class=\'no10\'></span>                
                        </div>
                    </td>
                    <td style="width: 60px">16
                    </td>
                    <td style="width: 60px">
                        大
                    </td>
                    <td style="width: 60px">
                        双
                    </td>
                        <td style="width: 60px" class=\'\'>
                            虎
                        </td>
                        <td style="width: 60px" class=\'kj52_bj_RedColor\'>
                            龍
                        </td>
                        <td style="width: 60px" class=\'kj52_bj_RedColor\'>
                            龍
                        </td>
                        <td style="width: 60px" class=\'\'>
                            虎
                        </td>
                        <td style="width: 60px" class=\'kj52_bj_RedColor\'>
                            龍
                        </td>

                </tr>
        </table>
    </div>
</div>';
    }
}
