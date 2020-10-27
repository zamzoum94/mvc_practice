<?php 

    class User{
        private $_db, $_error;

        public function __construct($user = null){
            $this->_db = Db::getInstance();
        }

        public function create($user){
            return $this->_db->query("INSERT INTO users(username, full_name, password, salt, birth_date, last_connection) 
            VALUES (?, ?, ?, ?, ?, NOW())",
            [$user["username"], $user["full_name"], $user["password"], $user["salt"], $user["birth_date"]])->getError();
        }

        public function check($user = array()){
            $login = $user["username"];
            $password = $user["password"];
            $result = $this->_db->query("SELECT * FROM users WHERE username = ?", [$login])->getResults()[0];
            if($result){
                if($result->password === Hash::make($password, $result->salt)){
                    Session::set("id", $result->id);
                    Session::flash("connected", "You logged in successfully");
                    return true;
                } else {
                    return "Wrong password";
                }
            } else{
                return "Login invalid";
            }
        }

        public static function loggout(){
            Session::delete("id");
        }

        public function getError(){
            return $this->_error;
        }
    }