<div class="container-fluid">

    <div class="row-fluid">
        <div class="span12">
            <div class="page-header">
                <h1>Edit post</h1>
            </div>
        </div>
    </div>

    <?php if (!empty($flash)): ?>
        <div class="row-fluid">
            <div class="span12">
                <div class="alert alert-block <?=$flash['style'] ?>">
                    <?= $flash['message'] ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <form action="<?= $currentUrl ?>" method="POST">
        <label for="title">Title</label>
        <div class="controls">
            <input type="text" class="span5" name="title" id="title" value="<?= $post['title'] ?>" placeholder="Title..."/>
        </div>
        <label for="text">Text</label>
        <div class="controls">
            <textarea name="text" class="span5" rows="5" id="text"><?= $post['text'] ?></textarea>
        </div>
        <p>
            <button class="btn btn-primary">Submit</button>
        </p>
    </form>
</div>
