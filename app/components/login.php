
<h1>Login</h1>
<?php
    if(Session::exists("id")){
        Reddirect::to("home");
    }
    if(Input::exists("post")){
        if(Token::check(Input::get("form"))){
            $user = new User();
            if($user->check($_POST) === true){
                Reddirect::to("home");
            } else{
                echo "<p>Wrong password</p>";
            }
        }
    }

    if(Session::exists("logout")){
        echo "<h3>". Session::flash("logout")."</h3>";
    }
?>
<div class="row">
    <div class="col-md-4">
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <input type="hidden" name="form" value=<?= Token::generate("form") ?>>
            <button type="submit" class="btn btn-primary">Login</button>
        <a href="?request=register"><small class="form-text text-muted">Don't have account?</small></a>
        </form>
    </div>  
</div>