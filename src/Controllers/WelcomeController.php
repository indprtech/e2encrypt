<?php
class Welcome extends Controller{
    public $defaultController = "index";

    public function index(){
        $data['test'] = "hello1";
        $this->Response("views","hello-e2e",$data);
    }
}