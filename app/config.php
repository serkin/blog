<?php

return [
    'routers' => [

        [
            'pattern' => '/post/',
            'class' => 'MyBlog\Controller\DefaultController',
            'method' => 'showPostAction'
        ],
        [
            'pattern' => '/auth/$',
            'class' => 'MyBlog\Controller\DefaultController',
            'method' => 'authorizationAction'
        ],
        [
            'pattern' => '/authform/',
            'class' => 'MyBlog\Controller\DefaultController',
            'method' => 'authFormAction'
        ],
        [
            'pattern' => '/newpostform/',
            'class' => 'MyBlog\Controller\DefaultController',
            'method' => 'newPostFormAction'
        ],
        [
            'pattern' => '/newpost/',
            'class' => 'MyBlog\Controller\DefaultController',
            'method' => 'newPostAction'
        ],
        [
            'pattern' => '/newcomment/',
            'class' => 'MyBlog\Controller\DefaultController',
            'method' => 'newCommentAction'
        ],
        [
            'pattern' => '/logout/',
            'class' => 'MyBlog\Controller\DefaultController',
            'method' => 'logoutAction'
        ],
        [
            'pattern' => '/',
            'class' => 'MyBlog\Controller\DefaultController',
            'method' => 'indexAction'
        ],
    ],

    'db' => [
        'userName' => 'root',
        'password' => '',
        'dsn'  => 'mysql:host=localhost;dbname=blog;charset=utf8'
    ]
];
