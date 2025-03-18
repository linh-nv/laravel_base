<?php
return [
    'user' => [
        [
            'id' => 0,
            'slug' => 'inactive',
            'name' => 'Hoạt động'
        ],
        [
            'id' => 1,
            'slug' => 'active',
            'name' => 'Không hoạt động'
        ],

    ],

    'category' => [
        [
            'id' => 0,
            'slug' => 'inactive',
            'name' => 'Hoạt động'
        ],
        [
            'id' => 1,
            'slug' => 'active',
            'name' => 'Không hoạt động'
        ],

    ],

    'invoice' => [
        [
            'id' => 0,
            'slug' => 'inactive',
            'name' => 'Hoạt động'
        ],
        [
            'id' => 1,
            'slug' => 'active',
            'name' => 'Không hoạt động'
        ],

    ],
        'pawn_receipt' => [
            [
                'id' => 0,
                'slug' => 'revoked',
                'bg_class' => 'bg-secondary',
                'name' => 'Đã huỷ'
            ],
            [
                'id' => 1,
                'slug' => 'active',
                 'bg_class' => 'bg-light',
                'name' => 'Hoạt động'
            ],
            [
                'id' => 2,
                'slug' => 'completed',
                'bg_class' => 'bg-success',
                'name' => 'Hoàn tất'
            ],
            [
                'id' => 3,
                'slug' => 'delay',
                'bg_class' => 'bg-danger',
                'name' => 'Chậm trả lãi'
            ],


        ],
        'product' => [
            [
                'id' => 0,
                'slug' => 'inactive',
                'name' => 'Không hoạt động'
            ],
            [
                 'id' => 1,
                 'slug' => 'active',
                 'name' => 'Hoạt động'
            ],


        ],
        'pawn_product' => [
            [
                'id' => 0,
                'slug' => 'in_warehouse',
                'name' => 'Nhập kho'
            ],
            [
                 'id' => 1,
                 'slug' => 'redeemed',
                 'name' => 'Đã chuộc'
            ],


        ],
]
?>
