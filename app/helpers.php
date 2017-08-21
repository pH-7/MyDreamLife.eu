<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

function site_url(string $var = ''): string
{
    if (!empty($var)) {
        return SITE_URL . $var;
    }

    return SITE_URL;
}

function asset_url(string $var = ''): string
{
    if (!empty($var)) {
        return SITE_URL . $var;
    }

    return SITE_URL . 'assets/';
}

function redirect(string $url): void
{
    if (strpos($url, 'http') === false) {
        $url = SITE_URL . $url;
    }

    header('Location: ' . $url);
    exit;
}

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES);
}
