<div class="container-fluid">

    <?php if (!empty($flash)): ?>
        <div class="well">
            <div class="row-fluid">
                <div class="span12">
                    <div class="alert alert-block <?=$flash['style'] ?>">
                        <?= $flash['message'] ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

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
                                <a href="/post/<?= $id ?>/edit" class="btn btn-large btn-primary">Edit post</a></div>
                            <div class="span2">
                                <a href="/post/<?= $id ?>/delete" class="btn btn-large btn-danger">Delete post</a>
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