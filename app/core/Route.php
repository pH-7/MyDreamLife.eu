<?php

use Controller\Base as BaseController;

class Route
{
    const GET_METHOD = 'GET';
    const POST_METHOD = 'POST';
    const PUT_METHOD = 'PUT';
    const DELETE_METHOD = 'DELETE';

    private static $httpMethod = self::GET_METHOD;

    public static function get(string $uri, string $classMethod = '')
    {
        self::$httpMethod = self::GET_METHOD;

        self::run($uri, $classMethod);
    }

    public static function post(string $uri, string $classMethod = '')
    {
        self::$httpMethod = self::POST_METHOD;
        self::run($uri, $classMethod);
    }

    public static function isHomepage(): bool
    {
        return empty($_GET['uri']);
    }

    /**
     * @param string $uri
     * @param string $function
     *
     * @return mixed
     */
    private static function run(string $uri, string $function)
    {
        $uri = '/' . trim($uri, '/');
        $url = !empty($_GET['uri']) ? '/' . $_GET['uri'] : '/';

        if (preg_match("#^$uri$#", $url, $params)) {
            if ($_SERVER['REQUEST_METHOD'] !== self::$httpMethod) {
                //throw new InvalidArgumentException(sprintf('HTTP Method Must be %s', self::$httpMethod));
                (new BaseController)->notFound();
            }

            $split = explode('@', $function);
            $className = 'Controller\\' . $split[0];
            $method = $split[1];

            $class = new $className;
            if (method_exists($class, $method)) {
                foreach ($params as $k => $v) {
                    $params[$k] = str_replace('/', '', $v);
                }
                return call_user_func_array(array($class, $method), $params);
            }
           //throw new RuntimeException('Method "' . $method . '" was not found in "' . $class . '" class.');
           (new BaseController)->notFound();
        }
    }
}
