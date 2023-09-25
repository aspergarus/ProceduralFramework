<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="page-header">
                <h1>Home page</h1>
            </div>
        </div>
    </div>

    <?php foreach ($flash as $message): ?>
        <div class="row-fluid">
            <div class="span12">
                <div class="alert alert-block <?= $message['style'] ?>">
                    <?= $message['message'] ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="row-fluid">
        <div class="span8">
            <?php foreach ($rows as $posts): ?>
                <div class="row-fluid">
                    <?php foreach ($posts as $id => $post): ?>
                        <div class="span4">
                            <h3>
                                <?= $post['title'] ?>
                                <?php if ($isAdmin): ?>
                                    id(<?= $id ?>)
                                <?php endif; ?>
                            </h3>
                            <p><?= $post['text'] ?></p>
                            <p>
                                <a href='/post/<?= $id ?>' class="btn btn-primary btn-large">View post</a>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="span4">
            <p>Sidebar menu</p>
        </div>
    </div>
</div>
