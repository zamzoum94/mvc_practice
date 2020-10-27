<?php


class Query{
    private $_db;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function getAll($search = ""){
        $results = $this->_db->query("SELECT * FROM post WHERE content LIKE CONCAT('%',?,'%')", [$search])->getResults();
        $query = $this->_db->getQuery();
        //var_dump($query);
        //$this->_db->query("INSERT INTO search_query(content, id_user) VALUES(?, ?)", )
        if($results){
            return $results;
        } else {
            return [];
        }
    }

    public function getLast($id){
        $results = $this->_db->query("SELECT last_query FROM users where id = ?", [$id])->getResults();
        if($results){
            return $results;
        } else{
            return [];
        }
    }
}