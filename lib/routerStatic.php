<?php

use function \Utils\container;
use function \Utils\d;

function defaultPageNotFound(): string {
    return "Page not found";
}

function get($path, $callBack, $role = null) {
    route('get', $path, $callBack, $role);
}

function post($path, $callBack, $role = null) {
    route('post', $path, $callBack, $role);
}

function route($type = 'get', $path = '', $callBack = null, $role = null) {
    static $routes;

    if ($path === '') {
        return $routes[$type];
    }

    if ($callBack === null) {
        return $routes[$type][$path] ?? null;
    }

    if ($role === 'admin' && !Role\isAdmin()) {
        return null;
    }

    $routes[$type][$path] = $callBack;
    return null;
}

function request($key = null) {
    [$uri] = explode('?', $_SERVER['REQUEST_URI']);
    $requestConfig = [
        'uri' => $uri,
        'method' => strtolower($_SERVER['REQUEST_METHOD']),
        'queryStr' => $_SERVER['QUERY_STRING'] ?? '',
        'parameters' => $_REQUEST
    ];

    if (!empty($key)) {
        return $requestConfig[$key];
    }

    return $requestConfig;
}

function run() {
    $uri = request('uri');
    $method = request('method');

    if (checkAssetsURI($uri)) {
        return false;
    }

    $callback = route($method, $uri);
    if ($callback) {
        echo $callback();
        exit();
    }

    $routes = route($method);

    foreach ($routes as $route => $closure) {
        if (strpos($route, ':') === false) {
            continue;
        }
        $searchPattern = changeRouteToRegex($route);
        preg_match($searchPattern, $uri, $matches);
        if (!empty($matches)) {
            processComplexRoute($closure, $matches);
        }
    }

    $callback = route('get', '/404') ?? 'defaultPageNotFound';
    echo $callback();
    exit();
}

function checkAssetsURI($uri) {
    $ext = pathinfo($uri, PATHINFO_EXTENSION);
    if (!in_array($ext, ['js', 'css', 'png', 'eot', 'svg', 'ttf', 'woff', 'otf'])) {
        return false;
    }

    container("PUBLIC_DIR");
    return file_exists(container("PUBLIC_DIR") . $uri);
}

function changeRouteToRegex(string $route) {
    $newRoute = strtr($route, ['/' => '\/']);

    $newRoute = preg_replace('/:\w+/i', '(\w+)', $newRoute, -1, $count);

    return '/^' . $newRoute . '$/i';
}

function processComplexRoute(callable $closure, array $matches) {
    $params = array_slice($matches, 1);

    echo $closure(...$params);
    exit();
}

function redirect($path, $statusCode = 303): void {
    header('Location: ' . $path, true, $statusCode);
    exit();
}
