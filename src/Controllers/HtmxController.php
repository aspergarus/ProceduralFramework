<?php

namespace Controllers\HtmxController;

use Closure;

use function Auth\setUser;
use function DB\get;
use function DB\insert;
use function Flash\setMessage;
use function PostRepository\PostDelete;
use function PostRepository\PostGet;
use function PostRepository\PostGetAll;
use function PostRepository\PostUpdate;
use function UserRepository\checkPass;
use function Validation\validate;

function coreAction(): Closure {
    return static function() {
        $posts = PostGetAll();
        $rows = array_chunk($posts, 3, true);
        return viewWithTemplate('htmx/core', [
            'rows' => $rows,
        ], 'htmx/template');
    };
}

function homeAction(): Closure {
    return static function() {
        $posts = PostGetAll();
        $rows = array_chunk($posts, 3, true);
        return view('htmx/core', [
            'rows' => $rows,
        ]);
    };
}

function viewPostAction(): Closure {
    return static function($id) {
        $post = PostGet($id);

        return view('htmx/post', [
            'post' => $post,
            'id' => $id
        ]);
    };
}

function loginForm(): Closure {
    return static function() {
        return view('htmx/login');
    };
}

function loginAction(): Closure {
    return static function() {
        $parameters = request('parameters');

        if (checkPass($parameters['user'], $parameters['pass'])) {
            setUser($parameters['user']);

            setMessage('You logged in');

            $homePage = '/htmx-test';

            header('HX-Location: ' . $homePage, true, 303);
        }

        setMessage('Wrong credentials');
        return view('htmx/login');
    };
}

function newPostPage(): Closure {
    return static function() {
        return view('htmx/addPost');
    };
}

function createPost(): Closure
{
    return static function() {
        if (empty(request('parameters'))) {
            setMessage('Input parameters are empty', 'error');
            return newPostPage()();
        }

        $parameters = request('parameters');

        $rules = ['title' => 'str|4..255', 'text' => 'str|12..1024'];
        [$validatedParameters, $errors] = validate($parameters, $rules);

        if (!empty($errors)) {
            foreach ($errors as $name => $error) {
                $errorMsg = sprintf("Field `%s` has error: %s", $name, $error);
                setMessage($errorMsg, 'error');
            }

            return newPostPage()();
        }

        /* @var $posts array */
        $posts = get("posts", []);

        $posts[] = ['title' => $validatedParameters['title'], 'text' => $validatedParameters['text']];
        insert('posts', $posts);

        setMessage('Post is created');

        return homeAction()();
    };
}

function viewDeletePost(): Closure
{
    return static function($id = 0) {
        return view('htmx/deletePost', [
            'id' => $id
        ]);
    };
}

function deletePost(): Closure
{
    return static function($id = 0) {
        $parameters = request('parameters');

        if (isset($parameters['delete'])) {
            PostDelete($id);
            setMessage('Post was deleted');

            $homePage = '/htmx-test';
            header('HX-Location: ' . $homePage, true, 303);
            return homeAction()();
        }

        if (isset($parameters['cancel'])) {
            return viewPostAction()($id);
        }

        setMessage('Wrong action');
        return viewPostAction()($id);
    };
}

function editPostPage(): Closure {
    return static function($id) {
        $post = PostGet($id);

        return view('htmx/editPost', [
            'post' => $post,
            'id' => $id
        ]);
    };
}

function editPostAction(): Closure {
    return static function($id) {
        $parameters = request('parameters');
        if (empty($parameters)) {
            setMessage('Parameters are empty', 'error');
            return editPostPage()($id);
        }

        $rules = ['title' => 'str|4..255', 'text' => 'str|12..1024'];
        [$validatedParameters, $errors] = validate($parameters, $rules);

        if (!empty($errors)) {
            foreach ($errors as $name => $error) {
                $errorMsg = sprintf("Field `%s` has error: %s", $name, $error);
                setMessage($errorMsg, 'error');
            }

            return editPostPage()($id);
        }

        PostUpdate($id, $validatedParameters);

        setMessage('Post is updated');

        return viewPostAction()($id);
    };
}
