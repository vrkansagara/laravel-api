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
        'image' => 'sometimes|mimes:jpeg,jpg,png,gif|max:10000',
        'password' => 'sometimes|max:80',
        'confirm_password' => 'sometimes|same:password',
    ]
];
