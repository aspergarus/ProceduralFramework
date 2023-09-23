<?php

namespace PostRepository;

use function \DB\get;
use function \DB\insert;

function PostGet($id) {
    $posts = get('posts', []);

    $post = $posts[$id] ?? null;

    if (!$post) {
        return null;
    }

    $post['id'] = $id;

    return $post;
}

function PostGetAll() {
    return get('posts', []);
}

function PostUpdate($id, $values) {
    $posts = get('posts', []);

    $posts[$id] = [
        'title' => $values['title'],
        'text' => $values['text'],
    ];

    insert('posts', $posts);
}

function PostDelete($id) {
    $posts = get('posts', []);

    unset($posts[$id]);

    insert('posts', $posts);
}
