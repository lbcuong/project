<?php
return [
    'directory' => [
        'images' => [
            'inventory' =>'app-assets/images/inventory',
            'avatar' => 'app-assets/images/users/avatar',
            'categories' => 'app-assets/images/categories'
        ]
    ],
    'is_approve' => [
        'pending' => 0,
        'approved' => 1,
        'disapprove' => 2,
        'exported' => 3
    ],

    'supplier_type' => [
        1 => ['id'=>1,'name' => 'Cá nhân'],
        2 => ['id'=>2,'name' => 'Công ty']
    ]
];
