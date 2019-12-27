<?php

return [
    "entities" => [
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
            "label" => "Posts",
            "icon" => "fa-book",
            "entity" => "post"
        ],
        [
            "label" => "Attachments",
            "icon" => "fa-paperclip",
            "entity" => "attachment"
        ]
    ]
];
