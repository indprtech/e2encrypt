<?php
class Controller extends Request{

    public function view($location,$parse = []){
        include(__DIR__ . "/../src/Views/$location.view.php");
    }

}