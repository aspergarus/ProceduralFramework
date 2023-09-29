<div class="container-fluid">

    <?php foreach ($flash as $message): ?>
        <div class="row-fluid">
            <div class="span12 well">
                <div class="alert alert-block <?= $message['style'] ?>">
                    <?= $message['message'] ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="well">
        <div class="row-fluid">
            <div class="span12">
                <?php if (!empty($post)): ?>
                    <h1><?= $post['title'] ?></h1>
                    <div class="lead">
                        <p><?= $post['text'] ?></p>
                    </div>
                    <?php if ($isAdmin): ?>
                        <div class="row-fluid">
                            <div class="span2">
                                <a hx-get="/htmx-post/<?= $id ?>/edit" hx-target="#target" class="btn btn-large btn-primary">Edit post</a></div>
                            <div class="span2">
                                <a hx-get="/htmx-post/<?= $id ?>/delete" hx-target="#target" class="btn btn-large btn-danger">Delete post</a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <h1>Post was not found</h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>