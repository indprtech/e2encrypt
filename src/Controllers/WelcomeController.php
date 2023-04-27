<?php
class Welcome extends Controller{
    public $defaultController = "index";
    public $file;
    function __construct(){
        $this->file = $this->library("file");
    }

    public function index(){
        $this->view("hello-e2e");
    }

    public function debugTest(){
        $this->file->setFileName("test.test");
        $this->file->setUploadPath("/");
        $this->file->setAllowedFileTypes(["jpg","test","png"]);
        $this->file->setMaxSize(50000);
        $this->file->setField("file");
        print_r($this->file->upload());
    }

    public function apiTest(){
        echo $this->Response('JSON' , ['status' => true, 'message' => "You've Successfully Saw the API!"]);
    }
}