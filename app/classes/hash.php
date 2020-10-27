<?php

    class Hash{
        public static function make($password, $salt = ""){
            return hash("sha256", $password . $salt);
        }

        public static function salt($length = 16){
            return random_bytes($length);
        }
    }