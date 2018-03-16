<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017-2018, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Controller;

use Core\Session;
use Core\View;

class Base
{
    public function __construct()
    {
        if (!Session::isActivated()) {
            @session_start();
        }
    }

    public function notFound(): void
    {
        header('HTTP/1.1 404 Not Found');

        View::create('not-found', 'Page Not Found');
    }
}
