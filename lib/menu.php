<?php

namespace Menu;

use function Utils\container;
use function Role\isAdmin;

function setup() {

    $menu = findUserConfigMenu();

    if (empty($menu)) {
        $menu = [
            '/' => [
                'title' => 'Home',
                'isAdmin' => false
            ]
        ];
    }

    container('menu', $menu);
}

function findUserConfigMenu(): array {
    $functions = get_defined_functions(true);

    $userDefinedMenuConfigFunctions = array_filter($functions['user'], function($funcName) {
        return strpos($funcName, 'menuconfig') !== false;
    });

    if (!empty($userDefinedMenuConfigFunctions)) {
        $userMenuConfig = array_pop($userDefinedMenuConfigFunctions);
        return $userMenuConfig();
    }

    return [];
}

function get(): array
{
    $menu = [];

    foreach (container('menu') as $uri => $link) {
        if ($link['isAdmin'] && !isAdmin()) {
            continue;
        }
        $menu[] = [
            'uri' => $uri,
            'name' => $link['title'],
            'class' => isCurrent($uri) ? 'active' : '',
        ];
    }

    return $menu;
}

function isCurrent($uri): bool
{
    return request('uri') === $uri;
}
