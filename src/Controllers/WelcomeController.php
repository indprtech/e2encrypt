<?php
class Welcome extends Controller{
    public $defaultController = "index";
    public $file;
    public $db;
    function __construct(){
        $this->file = $this->library("file");
        $this->db = $this->library("sqlite3");
    }

    public function index(){
        $this->view("hello-e2e");
    }

    public function debugTest(){
        $k = $this->db->delete("COMPANY","ID",4);
        print_r($k);
    }

    public function apiTest(){
        echo $this->Response('JSON' , ['status' => true, 'message' => "You've Successfully Saw the API!"]);
    }
}