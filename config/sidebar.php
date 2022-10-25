<?php
return [
    [
        "name" => "Danh mục",
        "id" => "category",
        "icon" => '<i class="fa-solid fa-list"></i>',
        "parent" => [
           [
            "name" => "Tất cả danh mục",
            "route" => "category.index",
            ],
           [
            "name" => "Tạo danh mục",
            "route" => "category.create",
            ],
        ],
    ],
    [
        "name" => "Sản phẩm",
        "id" => "product",
        "icon" => '<i class="fa-solid fa-list"></i>',
        "parent" => [
           [
            "name" => "Tất cả sản phẩm",
            "route" => "product.index",
            ],
           [
            "name" => "Tạo sản phẩm",
            "route" => "product.create",
            ],
        ],
    ],
    [
        "name" => "Bài viết",
        "route" => "post.index",
        "id" => "",
        "icon" => '<i class="fa-solid fa-copy"></i>',
        "parent" => "",
    ],
    [
        "name" => "Brand",
        "route" => "brand.index",
        "id" => "",
        "icon" => '<i class="fa-solid fa-copy"></i>',
        "parent" => "",
    ],
    [
        "name" => "Color",
        "route" => "color.index",
        "id" => "",
        "icon" => '<i class="fa-solid fa-copy"></i>',
        "parent" => "",
    ],
    [
        "name" => "Người dùng",
        "route" => "user.index",
        "id" => "",
        "icon" => '<i class="fa-solid fa-user"></i>',
        "parent" => "",
    ],
    [
        "name" => "Nhiệm vụ",
        "route" => "calendar.index",
        "id" => "",
        "icon" => '<i class="fa-solid fa-user"></i>',
        "parent" => "",
    ],
    [
        "name" => "Chấm công",
        "route" => "timkeeping",
        "id" => "",
        "icon" => '<i class="fa-solid fa-user"></i>',
        "parent" => "",
    ],
];
