<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? "SPA Blog" ?></title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://unpkg.com/htmx.org@1.9.6"></script>
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="brand" href="https://github.com/kristopolous/BOOTSTRA.386">Blog 386 BOOTSTRAP</a>

                <div class="nav-collapse collapse">
                    <?php if (!empty($user)): ?>
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Logged in as <?= $user ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" hx-post="/logout">Logout</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">System</li>
                                    <li><a href="/profile">Profile</a></li>
                                </ul>
                            </li>
                        </ul>
                        <?php else: ?>
                        <a class="navbar-link pull-right" hx-get="/htmx-login" hx-push-url="true" href="#" hx-target="#target">Login</a>
                    <?php endif; ?>

                    <ul class="nav">
                        <?php foreach ($menu as $link): ?>
                            <li class="<?= $link['class'] ?>" >
                                <a hx-get="<?= $link['uri'] ?>" hx-trigger="click" hx-push-url="true" hx-target="#target" href="#"><?= $link['name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="target">
        <?= $content ?>
    </div>

    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
</body>
</html>

