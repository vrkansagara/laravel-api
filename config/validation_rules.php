<?php

return [
    'login' => [
        'email' => 'required|email',
        'password' => 'required|min:3|max:80',
        'remember_me' => 'sometime'
    ],
    'register' => [
        'email' => 'required|email',
        'password' => 'required|min:3|max:80',
    ],
    'user_profile' => [
        'image' => 'sometime|file',
        'password' => 'required|min:3|max:80',
        'confirm_password' => 'required|same:password',
    ]
];
