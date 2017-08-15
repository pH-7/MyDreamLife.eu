<?php

define('APP_PATH', __DIR__ . DIRECTORY_SEPARATOR);

require 'config/site.php';
require 'helpers.php';
require 'core/Route.php';
require 'core/Database.php';
require 'core/Main.php';
require 'core/View.php';
require 'core/User.php';
require 'core/Session.php';
require 'core/Input.php';
require 'core/Hash.php';

function autoloadController($className) {
    $className = str_replace('\\', '/', $className);

    $filename = APP_PATH . $className . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

spl_autoload_register('autoloadController');


try {
    require 'routes.php';

    Main::store();
    Database::connect(Main::get('db'));


} catch (Exception $except) {
    echo $except->getMessage();
}



