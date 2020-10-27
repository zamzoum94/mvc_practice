<?php
    session_start();

    $GLOBALS["config"] = array(
        "mysql" => array(
            "host" => "127.0.0.1",
            "username" => "root",
            "password"=> "",
            "dbname" => "sql_practice"
        )
    );

    spl_autoload_register(function($class){
        require_once "../app/classes/{$class}.php";
    });

    require_once "../app/functions/sanatize.php";