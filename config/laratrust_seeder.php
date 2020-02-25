<?php

return [
    'role_structure' => [
        'bde' => [
            'users' => 'c,r,u,d,b',
            'discussions' => 'c,r,u,d',
            'categories' => 'c,r,u,d'
        ],
        'staff' => [
            'discussions' => 'r,d,s'
        ],
        'student' => [
            'discussions' => 'c,r,u,d'
        ],
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'b' => 'ban',
        's' => 'report'
    ]
];
