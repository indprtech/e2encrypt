<?php
class SqliteCore extends SQLite3{
    public $core;
    function __construct(){
        $this->core = new Core();
    }

    public function core(){
        $dCore = new Core();
        return $dCore;
    }
}