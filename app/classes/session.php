<?php

    class Session {
        public static function exists($name){
            if(isset($_SESSION[$name])){
                return true;
            }
            return false;
        }

        public static function set($name, $value){
            $_SESSION[$name] = $value;
        }

        public static function get($name){
            if(self::exists($name)){
                return $_SESSION[$name];
            }
        }

        public static function delete($name){
            if(self::exists($name)){
                unset($_SESSION[$name]);
            }
        }

        public static function flash($name, $message = ""){
            if(self::exists($name)){
                $message = self::get($name);
                self::delete($name);
                return $message;
            }
            return $_SESSION[$name] = $message;
        }
    }