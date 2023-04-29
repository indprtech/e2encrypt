<?php
class Welcome extends Controller{
    public $defaultController = "index";
    public $file;
    public $db;
    public $biscuit;
    function __construct(){
        $this->file = $this->library("file");
        $this->db = $this->library("sqlite3");
        $this->biscuit = $this->library("biscuit");
    }

    public function index(){
        if(isset($_GET['tests'])){
            $this->biscuit->set("hi",'nohi');
            $this->showTests();
            exit();
        }
        if(isset($_GET['sessionget'])){
            print_r($this->biscuit->get("hi"));
            exit();
        }
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