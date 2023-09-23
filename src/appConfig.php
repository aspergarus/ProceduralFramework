<?php

namespace AppConfig;

function menuConfig() {
    return [
        '/' => [
            'title' => "Home",
            'isAdmin' => false,
        ],
        '/post' => [
            'title' => "Add post",
            'isAdmin' => true
        ],
    ];
}
