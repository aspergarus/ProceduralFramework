<?php

# standard blog config
require_once __DIR__ . "/../src/appConfig.php";

# htmx blog config
# require_once __DIR__ . "/../src/htmxConfig.php";

require_once __DIR__ . "/../lib/app.php";

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

get("/api", Controllers\BaseController\apiTestAction());
post("/api", Controllers\BaseController\apiTestAction());

get("/htmx-test", Controllers\HtmxController\coreAction());
get("/htmx-home", Controllers\HtmxController\homeAction());

get("/htmx-post", Controllers\HtmxController\newPostPage());
post("/htmx-post", Controllers\HtmxController\createPost());

get("/htmx-post/:id", Controllers\HtmxController\viewPostAction());

get("/htmx-post/:id/delete", Controllers\HtmxController\viewDeletePost(), 'admin');
post("/htmx-post/:id/delete", Controllers\HtmxController\deletePost(), 'admin');

get("/htmx-post/:id/edit", Controllers\HtmxController\editPostPage(), 'admin');
post("/htmx-post/:id/edit", Controllers\HtmxController\editPostAction(), 'admin');


get("/htmx-login", Controllers\HtmxController\loginForm());
post("/htmx-login", Controllers\HtmxController\loginAction());



// return needed only if you run it using build-in php server.
// In this case if it does not found route, it will return source code which works perfect for output assets like
// css, js, images, etc.
// In case using some web server like nginx, it's better to setup different handlers for static content and for dynamic.
return run();
