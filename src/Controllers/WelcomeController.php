<?php
class Welcome extends Controller{
    public $defaultController = "index";

    public function index(){
        $this->view("hello-e2e");
    }
}