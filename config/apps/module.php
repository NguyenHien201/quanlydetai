<?php
    return [
        'module' => [
            'title' => 'Quản lý thành viên',
            'icon' => '<i class="menu-icon tf-icons bx bx-layout"></i>',
            'subModule' => [
                [
                    'title' => 'QL nhóm thành viên',
                    'route' => 'user.index'
                ],
                [
                    'title' => 'QL thành viên',
                    'route' => 'user.index'
                ]
            ]
        ],

        'orderModule' => [
            'subModule' => [
                [
                    'title' => 'Chờ giặt',
                    'bg_color' => 'bg-danger'
                ],
                [
                    'title' => 'Đang giặt',
                    'bg_color' => 'bg-warning'
                ],
                [
                    'title' => 'Đã giặt xong',
                    'bg_color' => 'bg-primary'
                ],
                [
                    'title' => 'Đã trả đồ',
                    'bg_color' => 'bg-success'
                ],
            ]
        ],       
    ];