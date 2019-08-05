<?php

return [
    'environment' => env('APP_ENV'),
    'supermost' => [
        'admin' => [
            'email' => env('SUPERMOST_ADMIN_EMAIL', null)
        ]
    ]
];
