<?php
class Routes{
    // Default Routes
    public $defaultController = "Welcome";

    //Routes
    public $routes = [
        '/' => array(
            'controller' => "Welcome",
            'route' => "index"
        )
    ];
}