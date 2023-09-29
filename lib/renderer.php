<?php

use function \Utils\container;

function view($name, $params = []) {
    $ext = '.php';
    $file = container("VIEW_DIR") . '/' . $name . $ext;
    $flash = Flash\getMessages();
    $user = Auth\getUser();
    $isAdmin = Role\isAdmin($user);

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
    $flash = Flash\getMessages();
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

function json($params, $code = 200): void {
    header('Content-Type: application/json', true, $code);

    $jsonStr = json_encode($params);

    if (!empty(json_last_error())) {
        $jsonErrorMessage = json_last_error_msg();
        http_response_code(422);
        echo "{\"error\": $jsonErrorMessage}";
        exit();
    }

    echo $jsonStr;
}
