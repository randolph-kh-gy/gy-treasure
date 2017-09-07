<?php

return [
    'type'      => 'ssc',
    'is_owner'  => true,
    'issuerule' => 'Ymd-[n3]|0,1,0',
    'issueset'  => [
        [
            'starttime'     => '00:00:15',
            'firstendtime'  => '00:05:15',
            'endtime'       => '05:00:15',
            'cycle'         => 300,
            'endsale'       => 0,
            'inputcodetime' => 0,
            'droptime'      => 0,
            'status'        => 1,
            'sort'          => 0,
        ], [
            'starttime'     => '07:00:15',
            'firstendtime'  => '07:05:15',
            'endtime'       => '00:00:15',
            'sort'          => 1,
            'cycle'         => 300,
            'endsale'       => 0,
            'inputcodetime' => 0,
            'droptime'      => 0,
            'status'        => 1,
        ],
    ],
];
