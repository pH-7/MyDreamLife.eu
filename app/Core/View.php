<?php

declare(strict_types=1);

namespace Core;

use RuntimeException;

class View
{
    public const PARTIALS_ENABLED = true;
    public const PARTIALS_DISABLED = false;

    /**
     * @param string $view
     * @param string $title
     * @param array $data
     *
     * @throws RuntimeException
     */
    public static function create(string $view, string $title = '', array $data = array(), bool $paritals = self::PARTIALS_DISABLED): void
    {
        extract($data);

        if (!$paritals) {
            include 'templates/header.php';
        }

        $viewFullPath = 'templates/' . $view . '.php';
        if (is_file($viewFullPath)) {
            include $viewFullPath;
        } else {
            $errorMessage = sprintf('Could not find view: "%s"', $viewFullPath);
            throw new RuntimeException($errorMessage);
        }

        if (!$paritals) {
            include 'templates/footer.php';
        }
    }
}
