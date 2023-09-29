<?php

use function Menu\setup;
use function Utils\container;

// Include parts of framework/lib
require_once "utils.php";
require_once "routerStatic.php";
require_once "menu.php";
require_once "renderer.php";
require_once "db.php";
require_once "flash.php";
require_once "auth.php";
require_once "role.php";
require_once "validation.php";
// end parts of framework

// Include parts of app code
require_once __DIR__ . "/../src/Controllers/PostController.php";
require_once __DIR__ . "/../src/Controllers/UserController.php";
require_once __DIR__ . "/../src/Controllers/BaseController.php";
require_once __DIR__ . "/../src/Controllers/HtmxController.php";
require_once __DIR__ . "/../src/Repository/PostRepository.php";
require_once __DIR__ . "/../src/Repository/UserRepository.php";
// end parts of app code

container("LIB_DIR", __DIR__);
container("VIEW_DIR", __DIR__ . "/../views");
container("STORAGE_DIR", __DIR__ . "/../storage");
container("PUBLIC_DIR", __DIR__ . "/../public");

setup();
