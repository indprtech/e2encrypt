<?php
class Controller extends Request{
    /* Type[Deprecated] */
    public function view($location,$parse = []){
        include(__DIR__ . "/../../src/Views/$location.view.php");
    }
}