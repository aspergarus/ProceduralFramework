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