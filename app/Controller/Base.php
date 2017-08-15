<?php

namespace Controller;

use View;

class Base
{
    public $root = './app/models/';
    public $name;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            @session_start();
        }
    }

    public function notFound()
    {
        header('HTTP/1.1 404 Not Found');

        View::create('not-found', 'Page Not Found');
    }

    public function loadModel($name)
    {
        $modelFile = $this->root . $name . '_model.php';
        require $modelFile;
        $this->name = $name;
    }

    public function modelFunction($func, array $vars = array())
    {
        $className = $this->name . '_model';
        return call_user_func_array(array(new $className, $func), $vars);
    }
}