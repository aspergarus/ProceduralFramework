# ProceduralFramework
Tiny framework, or even library that support some basic operations like routing, template system and etc. Main aim here was to challenge myself to avoid any classes and OOP features in order to create minimal framework/lib that can help to build some app. For example blog.

## Run

> php -S 0.0.0.0:1234 index.php

Open in browser localhost:1234

## Run in docker

> cd deploy
> make web

Open in browser localhost:5000

## Challenge

The main challange was how to keep state of the app. In OOP state can be some object, which we pass to app object, and then we may ask whenever we want it.
But pretending that objects don't exists, we need to deal only with functions. So here I see 3 ways how to do it.

1. Using global variables. [Example of router](https://gist.github.com/aspergarus/0f632bc9050f8f851927b9f522a9a61e)
2. Using static variables inside functions. [Example of container](https://gist.github.com/aspergarus/b26c5ce90138d689ca5641644ece7b94)
3. Using functions as closure with closed state from the caller. [Example of router](https://gist.github.com/aspergarus/b2a56ece47d9409a47261a1bbaa0d47e)
4. Using passing parameters everytime when we need some state. [Example of router](https://gist.github.com/aspergarus/e1ea98febafaea25124455b0247173da)

I rejected 1, as it's really easy to implement, but sometimes you may get into trouble since you have global scope, and every know that global is evil.
Also, I rejected 3, since it makes code really hard to support. 
Variant #4 seems to me the best, but it requires additional work everytime when we need to use some 'global' config. So, it's possible to develop it, but require solid investigation and preparation. Because if you will not prepare properly, you will change your architecture too often, which requires a lot of changes.

Therefore, my choice is #2. Yeah, it's not so perfect, and actually it also exposes everything in global scope, you just need to use proper function. But at least it makes more safe naming of data, comparing to global scope.

## Naming

It's named ProceduralFramework, as it doesn't use any classes, only functions. But it's hard to name it as Functional framework, as functions here basically are not pure and hold the state.

## Folder structure

```
├── bin      -- has CLI helper to create user in local db
├── lib      -- contains all files related to the framework
├── public   -- contain front controller and all assets of example application
├── src      -- contains source code of the app. Basically if you want to build some other site, you need to make changes here for backend part.
│   ├── appConfig.php
│   ├── Controllers -- user defined controllers. Used in front controller.
│   └── Repository  -- user defined repositories. Used to easy access to entities in DB.
├── storage -- contains local db files. Make it writable if you have issues with writing/reading DB.
└── views  -- contains php files that have html code. `template.php` is a basic template, which is used to render basic template of the site, like header and footer. Specific content is rendered by other view files herer.
```

## Implemented features

1. Router.

    It support simple routes which matches as is, and also more complex, where you may define some variable path parameter. Examples of routes: `/user`, `/user/:id`, `/user/:id/edit`. 
   
2. View/template system.

    Firstly it could only render the whole page without reusing any html. It works well only if you have 1-2 pages. If you have more page, you need to modify all your pages everytime when you make any change for example in head section or in header/footer(like menu). Therefore I developed basic template system, where you may render some content inside some template. In my example I use only 1 template, but it can use any templates. As template system I use html and raw php.

3. DB.

    I didn't want to setup mysql or any other dedicated server DB. It should be simple, just to pass the challange. So I used DB based on local file. Firstly I was thinking about sqlite. But I would like to try something new(for me). So I chose DBA, which allow you to store data in local files like `key => value` pairs.

4. Flash

    Just to show some messages after some actions. Like, after created some entity show message `You added entity bla-bla...`.

5. Auth

    It's simple authentication, based on session and cookie. User is stored in DB like array with name and password hash.

6. CLI

    It's not actually fully featured CLI, it's just a helper to create admin users in DB using CLI. Check `./bin/user.php`

## App features

The challenge was not only build some framework or lib, but also to use it. I tried to build simple blog system, where user may login/logout, view the posts. Admin user(actually any user that logged in), may also create/edit/delete posts.

To make it beautiful, I use bootstrap. I also wanted to try bootstrap theme 386, which looks like computer interface from 80-90s.

There is spa based on htmx. To check it, use /htmx-test url.

## TODO

1. ~~Validation. Currently, I almost skip validation of the input for creating/editing posts.~~

2. Maybe implement some features like tag-cloud for the posts, or create not only posts, but some articles.

3. ~~Implement rendering in json,~~ and try to create the same app as SPA

4. ~~Use htmx or turbo to make it SPA.~~

5. ~~Implement docker to run php in container.~~
