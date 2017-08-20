<?php

function site_url(string $var = '') {
    if (!empty($var)) {
        return SITE_URL . $var;
    }

    return SITE_URL;
}

function asset_url(string $var = '') {
    if (!empty($var)) {
        return SITE_URL . $var;
    }

    return SITE_URL . 'assets/';
}

function redirect($url) {
    if (strpos($url, 'http') === false) {
        $url = SITE_URL . $url;
    }

    header('Location: ' . $url);
    exit;
}