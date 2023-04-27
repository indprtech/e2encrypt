<?php
class Routes{
    // Default Routes
    public $defaultController = "Welcome";

    //Routes
    public $routes = [
        '/' => array(
            'controller' => "Welcome",
            'route' => "index"
        ),
        '/api/test' => array(
            'controller' => "Welcome",
            'route' => "debugTest"
        )
    ];
}