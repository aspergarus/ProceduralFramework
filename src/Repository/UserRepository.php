<?php

namespace UserRepository;

function get($name) {
    $users = \DB\get('users', []);

    return $users[$name];
}

function checkPass($name, $pass) {
    $user = get($name);
    $user['pass'] ??= '';

    return password_verify($pass,  $user['pass']);
}
