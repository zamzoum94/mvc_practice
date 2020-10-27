<?php
    if(Session::exists("id")){
        if(Session::exists("connected")){
            echo "<h4>". Session::flash('connected') . "</h4>";
        }
    } else {
        Reddirect::to("login");
    }
?>

<nav class="navbar navbar-dark bg-light">
    <div class="d-flex justify-content-end">
        <a class="nav-link" href="?request=logout">Logout</a>
    </div>
</nav>

<h1>Home</h1>
<div class="row">
    <div class="col-md-6">
        <?php require_once "search_query.php"?>
    </div>
    <div class="col-md">
        <?php require_once "post.php"?>
    </div>
</div>

