<?php

return [
    'type'      => 'ssc',
    'is_owner'  => true,
    'issuerule' => 'Ymd-[n3]|0,1,0',
    'issueset'  => [
        [
            'starttime'     => '00:01:10',
            'firstendtime'  => '00:03:10',
            'endtime'       => '04:59:10',
            'cycle'         => 120,
            'endsale'       => 0,
            'inputcodetime' => 0,
            'droptime'      => 0,
            'status'        => 1,
            'sort'          => 0,
        ], [
            'starttime'     => '07:01:10',
            'firstendtime'  => '07:03:10',
            'endtime'       => '00:01:10',
            'cycle'         => 120,
            'endsale'       => 0,
            'inputcodetime' => 0,
            'droptime'      => 0,
            'status'        => 1,
            'sort'          => 1,
        ],
    ],
];
