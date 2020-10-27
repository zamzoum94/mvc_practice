<?php

    class Router{
        public static function getRoute($path = array()){
            if(isset($path["request"])){
                return $path["request"];
            } else{
                return "";
            }
        }

        public static function getParams($params = array()){
            unset($params["request"]);
            $strParams = "";
            foreach($params as $key=>$value){
                $strParams .= "&{$key}={$value}";
            }
            return $strParams;
        }
    }