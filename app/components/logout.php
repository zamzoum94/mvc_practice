<?php
    if(Session::exists("id")){
        Session::delete("id");
        Session::flash("logout", "You just logged out!");
    }
    Reddirect::to("login");