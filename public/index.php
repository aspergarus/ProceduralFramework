<?php

require_once "../lib/app.php";

get("/", Controllers\BaseController\homeAction());

get("/post", Controllers\PostController\viewCreatePost(), 'admin');

post("/post", Controllers\PostController\createPost(), 'admin');

get("/post/:id", Controllers\PostController\viewPost());

get("/post/:id/edit", Controllers\PostController\viewEditPost(), 'admin');

post("/post/:id/edit", Controllers\PostController\editPost(), 'admin');

get("/post/:id/delete", Controllers\PostController\viewDeletePost(), 'admin');

post("/post/:id/delete", Controllers\PostController\deletePost(), 'admin');

get("/login", Controllers\UserController\loginPage());

post("/login", Controllers\UserController\loginAction());

get("/logout", Controllers\UserController\logoutAction());

get("/profile", Controllers\BaseController\notImplementedYet());

get("/404", Controllers\BaseController\notFound());

// return needed only if you run it using build-in php server.
// In this case if it does not found route, it will return source code which works perfect for output assets like
// css, js, images, etc.
// In case using some web server like nginx, it's better to setup different handlers for static content and for dynamic.
return run();
