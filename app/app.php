<?php
    require_once "core/init.php";

    if(empty($_GET)){
        require_once "components/home.php";
    } else {
        $target = Router::getRoute($_GET);
        $params = Router::getParams($_GET);
        unset($_GET['request']);
        if(is_file("../app/components/{$target}.php")){
            require_once "components/{$target}.php";
        } else{
            require_once "components/404.php";
        }
    }  
?>