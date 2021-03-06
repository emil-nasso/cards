<?php

return [
    "entities" => [
        "category" => [
            "list" => \App\Sharp\CategoryList::class,
            "form" => \App\Sharp\CategoryForm::class,
        ],
        "post" => [
            "list" => \App\Sharp\PostList::class,
            "form" => \App\Sharp\PostForm::class,
        ],
        "attachment" => [
            "list" => \App\Sharp\AttachmentList::class,
            "form" => \App\Sharp\AttachmentForm::class,
        ],
    ],
    "menu" => [
        [
            "label" => "Categories",
            "icon" => "fa-folder",
            "entity" => "category",
        ],
        [
            "label" => "Posts",
            "icon" => "fa-book",
            "entity" => "post",
        ],
        [
            "label" => "Attachments",
            "icon" => "fa-paperclip",
            "entity" => "attachment",
        ]
    ]
];
