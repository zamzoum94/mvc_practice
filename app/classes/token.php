<?php


class Token {
    public static function generate($name){
        $token = md5(uniqid());
        Session::set($name, $token);
        return $token;
    }


    public static function check($token){
        if(Session::exists("form") && $token === Session::get("form")){
            Session::delete("form");
            return true;
        }
        return false;
    }
}