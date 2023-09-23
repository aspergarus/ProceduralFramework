<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="page-header">
                <h1>Login</h1>
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

    <form action="<?= $currentUrl ?>" method="POST" class="form-horizontal">
        <div class="control-group">
            <label class="control-label" for="user">Username</label>
            <div class="controls">
                <input type="text" name="user" id="user" placeholder="Login"/>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="pass">Password</label>
            <div class="controls">
                <input type="password" name="pass" id="pass" placeholder="Password"/>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
