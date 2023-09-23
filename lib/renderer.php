<?php

use function \Utils\container;

function view($name, $params = []) {
    $ext = '.php';
    $file = container("VIEW_DIR") . '/' . $name . $ext;

    extract($params);

    ob_start();
    require_once $file;

    return ob_get_clean();
}

function viewWithTemplate($name, $params = [], $template = 'template') {
    $ext = '.php';
    $view = container("VIEW_DIR") . '/' . $name . $ext;

    $uri = request('uri');
    $currentUrl = $uri;
    $menu = Menu\get();
    $flash = Flash\getMessage();
    $user = Auth\getUser();
    $isAdmin = Role\isAdmin($user);

    extract($params);

    ob_start();
    require_once $view;
    $content = ob_get_clean();

    $template = container("VIEW_DIR") . '/' . $template . $ext;

    ob_start();
    require_once $template;
    return ob_get_clean();
}
