<?php
    class Post{
        private $_db;

        public function __construct(){
            $this->_db = DB::getInstance();
        }

        public function create($items){
            var_dump($items);
            //die();
            $result = $this->_db->query("INSERT INTO post(content, category, created_at, updated_at) VALUES(?, ?, CURDATE(), CURDATE())", [$items['content'], $items['category']]);

            if($result->getError()){
                var_dump($result->getError());
                die();
                //echo "Some error occured, couldn't post {$result->getError()[3]}";
            } else {
                Session::flash("post", "You succefully post");
            }
        }
    }