<?php

    class DB{
        private static $_instance = null;
        private $_db,
                $_query,
                $_results,
                $_error,
                $_count;
        
        private function __construct(){
            try{
                $host = Config::get("mysql/host");
                $username = Config::get("mysql/username");
                $password = Config::get("mysql/password");
                $dbname = Config::get("mysql/dbname");
                $this->_db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
            } catch(PDOExcepetion $e){
                die($e->getMessage());
            }
        }

        public static function getInstance(){
            if(is_null(self::$_instance)){
                self::$_instance = new DB();
            }
            return self::$_instance;
        }

        public function query($sql, $params = array()){
            $this->_error = false;
            if($this->_query = $this->_db->prepare($sql)){
                if(count($params)){
                    $x = 1;
                    foreach($params as $bind){
                        $this->_query->bindValue($x++, $bind);
                    }
                }
                if($this->_query->execute()){
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                } else{
                    $this->_error = $this->_query->errorInfo();
                }
            }
            return $this;
        }

        public function getError(){
            return $this->_error;
        }

        public function getResults(){
            return $this->_results;
        }

        public function getCount(){
            return $this->_count;
        }

        public function getQuery(){
            return $this->_query;
        }
    }