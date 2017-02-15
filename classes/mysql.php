<?php

class mysql
{// class begin
    // class variables
var $conn = false;
var $host = false;
var $user = false;// database server user username
var $pass = false;// database server user password
var $dbname = false; // database server user database
var $history = array(); // database query log array
// class methods
// construct
function __construct($h, $u, $p, $dn) {
        $this->host = $h;
        $this->user = $u;
        $this->pass = $p;
        $this->dbname = $dn;
        $this->connect();
}// construct
    // connect to database server and use database
    function connect() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        if(!$this->conn) {
            echo 'Problem connecting to database<br>';
            exit;
        }
    }// connect

    // control query time
    function getMicrotime(){
    list($usec, $sec) = explode (' ', microtime());
    return ((float)$usec + (float)$sec);
    }// getMicrotime


    // query to database
    function query($sql) {
        $begin = $this->getMicrotime();

        $res = mysqli_query($this->conn, $sql);
        if($res == false) {
            echo 'Viga p2rinugs <b>' . $sql . '<br>';
            echo mysqli_error($this->conn) . '<br>';
            exit;
        }
        $time = $this->getMicrotime() - $begin;
        $this->history[] = array(
            'sql' => $sql,
            'time' => $time
        );
        return $res;
}// query
    // query with data result
    function getArray($sql){
        $res = $this->query($sql);
        $data = array();
        while($record = mysqli_fetch_assoc($res)){
            $data[] = $record;
        }
        if(count($data) == 0){
            return false;
        }
        return $data;
    }// getArray

    // output query history log array
    function showHistory(){
        if(count($this->history) > 0) {
            echo '<hr>';
            foreach ($this->history as $key=>$val) {
                echo '<li>'.$val['sql'].'<br>';
                echo '<strong>'.round($val['time']).'</strong><br></li>';
            }
        }
    }// showhistory

}// class end