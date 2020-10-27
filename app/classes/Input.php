<?php
    class Input{
        public static function exists($type = "post"){
            switch($type){
                case "post" : return empty($_POST) ? false : true;
                case "get" : return empty($_GET) ? false : true;
                default : return false;
            }
        }
        

        public static function get($target){
            if(isset($_GET[$target])){
                return $_GET[$target];
            } else if(isset($_POST[$target])){
                return $_POST[$target];
            } else return "";
        }
    }