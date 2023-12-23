<?php 
    return [
        'module' => [
            [
                'title' => 'User Managements',
                'icon' => 'fa fa-group',
                'name' => 'user',
                'subModule' => [
                    [
                        'title' => 'User Management',
                        'route' => '/user/index'
                    ],
                    [
                        'title' => 'Group User Management',
                        'route' => '/user/catalogue/index'
                    ]
                    
                ]  
            ],
            [
                'title' => 'Post Managements',
                'icon' => 'fa fa-file',
                'name' => 'post',
                'subModule' => [
                    [
                        'title' => 'Post Management',
                        'route' => '/post/index'
                    ],
                    [
                        'title' => 'Group Post Management',
                        'route' => '/post/catalogue/index'
                    ]
                    
                ]  
            ]
        ]
    ];
