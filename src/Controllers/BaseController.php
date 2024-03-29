<?php

namespace Controllers\BaseController;

use Closure;
use function PostRepository\PostGetAll;

function notImplementedYet(): Closure
{
    return static function() {
        return viewWithTemplate('not_implemented_yet');
    };
}

function notFound(): Closure
{
    return static function() {
        return "The page you are looking for is not found";
    };
}

function homeAction(): Closure
{
    return static function() {
        $posts = PostGetAll();
        $rows = array_chunk($posts, 3, true);
        return viewWithTemplate('home', [
            'rows' => $rows,
        ]);
    };
}

function apiTestAction(): Closure
{
    return static function () {
        $params = [
            'test' => '111',
            'items' => [
                [
                    'item' => [
                        'name' => "midway",
                        'price' => 123.0
                    ],
                    'id' => 123
                ],
                [
                    'item' => [
                        'name' => "lexington",
                        'price' => 321.0
                    ],
                    'id' => 124
                ],
            ]
        ];

        json($params);
    };
}
