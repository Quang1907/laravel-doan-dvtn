<?php
return [
    [
        "name" => "Danh mục",
        "id" => "category",
        "icon" => '<i class="fa-solid fa-list" style="font-size:20px"></i>',
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
        "icon" => '<i class="fa-solid fa-list-check" style="font-size:20px"></i>',
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
        "icon" => '<i class="fa-solid fa-signs-post" style="font-size:20px"></i>',
        "parent" => "",
    ],
    [
        "name" => "Brand",
        "route" => "brand.index",
        "id" => "",
        "icon" => '<i class="fa-regular fa-pen-to-square" style="font-size:20px"></i>',
        "parent" => "",
    ],
    [
        "name" => "Color",
        "route" => "color.index",
        "id" => "",
        "icon" => '<i class="fa-brands fa-slack" style="font-size:20px"></i>',
        "parent" => "",
    ],
    [
        "name" => "Slider",
        "route" => "slider.index",
        "id" => "",
        "icon" => '<i class="fa-brands fa-slack" style="font-size:20px"></i>',
        "parent" => "",
    ],
    [
        "name" => "Người dùng",
        "route" => "user.index",
        "id" => "",
        "icon" => '<i class="fa-solid fa-user" style="font-size:20px"></i>',
        "parent" => "",
    ],
    [
        "name" => "Nhiệm vụ",
        "route" => "calendar.index",
        "id" => "",
        "icon" => '<i class="fa-solid fa-thumbtack" style="font-size:20px"></i>',
        "parent" => "",
    ],
    [
        "name" => "Chấm công",
        "route" => "timkeeping",
        "id" => "",
        "icon" => '<i class="fa-solid fa-file-pen" style="font-size:20px"></i>',
        "parent" => "",
    ],
];
