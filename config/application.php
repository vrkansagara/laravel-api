<?php
return [
    'response' => [
        'type' => 'json' // json, JSONP, HAL JSON, XML
    ],
    'database' => [
        'mysql' => [
            'charset' => 'utf8',
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ]
    ],
    'datatable' => [
        'pageLength' => env('SHORT_PAGINATION',10)
    ]
];
