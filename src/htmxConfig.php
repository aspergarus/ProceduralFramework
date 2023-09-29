<?php

function menuConfig() {
    return [
        '/htmx-home' => [
            'title' => "Home",
            'isAdmin' => false,
        ],
        '/htmx-post' => [
            'title' => "Add post",
            'isAdmin' => true
        ],
    ];
}
