<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

use Core\Main;
use Core\Database;

ini_set('display_errors', 'on');

define('APP_PATH', __DIR__ . DIRECTORY_SEPARATOR);

require 'config/site.php';
require 'helpers.php';

function autoloadClasses($className) {
    $className = str_replace('\\', '/', $className);

    $filename = APP_PATH . $className . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

spl_autoload_register('autoloadClasses');


try {
    Main::store();
    Database::connect(Main::get('db'));

    require 'routes.php';
} catch (Exception $except) {
    echo $except->getMessage();
}



