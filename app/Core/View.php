<?php

namespace Core;

use RuntimeException;

class View
{
    /**
     * @param string $view
     * @param string $title
     * @param array $data
     */
    public static function create(string $view, string $title = '', array $data = array()): void
    {
        extract($data);

        include 'templates/header.php';

        $viewFullPath = 'templates/' . $view . '.php';
        if (is_file($viewFullPath)) {
            include $viewFullPath;
        } else {
            throw new RuntimeException('Could not find view: "' . $viewFullPath . '"');
        }

        include 'templates/footer.php';
    }

    /**
     * @param string $view
     * @param string $title
     * @param int $paritals
     * @param array $data
     */
    public static function admin(string $view, $title = '', int $paritals = 1, array $data = array()): void
    {
        extract($data);

        $viewFullPath = APP_PATH . 'admin/templates/' . $view . '.php';
        if (is_file($viewFullPath)) {
            throw new RuntimeException('Could not find view: "' . $viewFullPath . '"');
        }

        if (!$paritals == 1) {
            include $viewFullPath;
        } else {
            include APP_PATH . 'admin/templates/header.php';
            include $viewFullPath;
            include APP_PATH . 'admin/templates/footer.php';
        }
    }
}