<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="page-header">
                <h1>Delete post</h1>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12 lead">
            <p>Are you sure you want to delete post with id - <?= $id ?></p>
        </div>
    </div>

    <form hx-post="/htmx-post/<?= $id ?>/delete" hx-target="#target">
        <button class="btn btn-primary btn-danger" name="delete">Delete</button>
        <button class="btn btn-primary" name="cancel">Cancel</button>
    </form>
</div>
