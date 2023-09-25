<?php

namespace Controllers\PostController;

use Closure;
use function DB\insert;
use function DB\get;
use function Flash\setMessage;
use function PostRepository\PostDelete;
use function PostRepository\PostGet;
use function PostRepository\PostUpdate;
use function Validation\validate;

function viewCreatePost(): Closure
{
    return static function() {
        return viewWithTemplate('addPost');
    };
}

function createPost(): Closure
{
    return static function() {
        if (empty(request('parameters'))) {
            setMessage('Input parameters are empty', 'error');
            redirect('/post');
        }

        $parameters = request('parameters');

        $rules = ['title' => 'str|4..255', 'text' => 'str|12..1024'];
        [$validatedParameters, $errors] = validate($parameters, $rules);

        if (!empty($errors)) {
            foreach ($errors as $name => $error) {
                $errorMsg = sprintf("Field `%s` has error: %s", $name, $error);
                setMessage($errorMsg, 'error');
            }
            redirect('/post');
        }

        /* @var $posts array */
        $posts = get("posts", []);

        $posts[] = ['title' => $validatedParameters['title'], 'text' => $validatedParameters['text']];
        insert('posts', $posts);

        setMessage('Post is created');

        redirect("/");
    };
}

function viewPost(): Closure
{
    return static function($id = 0) {
        $post = PostGet($id);

        return viewWithTemplate('post', [
            'post' => $post,
            'id' => $id
        ]);
    };
}

function viewEditPost(): Closure
{
    return static function($id = 0) {
        $post = PostGet($id);

        return viewWithTemplate('editPost', [
            'post' => $post,
            'id' => $id
        ]);
    };
}

function editPost(): Closure
{
    return static function($id = 0) {
        $parameters = request('parameters');
        if (empty($parameters)) {
            setMessage('Parameters are empty', 'error');
            redirect("/post/$id/edit");
        }

        $rules = ['title' => 'str|4..255', 'text' => 'str|12..1024'];
        [$validatedParameters, $errors] = validate($parameters, $rules);

        if (!empty($errors)) {
            foreach ($errors as $name => $error) {
                $errorMsg = sprintf("Field `%s` has error: %s", $name, $error);
                setMessage($errorMsg, 'error');
            }
            redirect('/post/$id/edit');
        }

        PostUpdate($id, $validatedParameters);
        setMessage('Post is updated');
        redirect("/post/$id");
    };
}

function viewDeletePost(): Closure
{
    return static function($id = 0) {
        return viewWithTemplate('deletePost', [
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
            redirect('/');
        }

        if (isset($parameters['cancel'])) {
            redirect("/post/$id");
        }

        return "Wrong action";
    };
}
