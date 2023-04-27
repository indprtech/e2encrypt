<?php
class Welcome extends Controller{
    public $defaultController = "index";

    public function index(){
        $this->view("hello-e2e");
    }

    public function apiTest(){
        $this->Response('XML' , ['status' => true, 'message' => "You've Successfully Saw the API!"]);
    }
}