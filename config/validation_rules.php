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
    'user' => [
        'profile' => [
            'image' => 'sometime|mimes:jpeg,jpg,png,gif|max:10000',
//            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'image2' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'password' => 'sometimes|max:80',
            'confirm_password' => 'sometimes|same:password',
        ],
        'create_edit' => [
            'name' => 'required|max:80',
            'email' => 'required|email',
            'password' => 'sometimes|max:80',
            'confirm_password' => 'sometimes|same:password',
        ]
    ]
];
