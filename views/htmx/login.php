<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="page-header">
                <h1>Login</h1>
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

    <form hx-post="/htmx-login" hx-push-url="true" class="form-horizontal" hx-target="#target">
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
