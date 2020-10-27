<?php


class Reddirect {
    public static function to($path){
        header("location: ?request={$path}");
    }
}