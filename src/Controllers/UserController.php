<?php

namespace Controllers\UserController;

use Closure;
use function Auth\logout;
use function Auth\setUser;
use function Flash\setMessage;
use function UserRepository\checkPass;

function loginPage(): Closure
{
    return static function() {
        return viewWithTemplate('login');
    };
}

function loginAction(): Closure
{
    return static function() {
        $parameters = request('parameters');

        if (checkPass($parameters['user'], $parameters['pass'])) {
            setUser($parameters['user']);
            setMessage('You logged in');

            redirect('/');
        }

        setMessage('Wrong credentials');
        redirect('/login');
    };
}

function logoutAction(): Closure
{
    return static function() {
        logout();
        setMessage("You was successfully logged out");
        redirect("/");
    };
}