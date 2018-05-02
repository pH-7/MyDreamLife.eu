<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017-2018, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types=1);

namespace Core;

use Controller\Base as BaseController;
use InvalidArgumentException;
use RuntimeException;

class Route
{
    public const GET_METHOD = 'GET';
    public const POST_METHOD = 'POST';
    public const PUT_METHOD = 'PUT';
    public const DELETE_METHOD = 'DELETE';

    private const CONTROLLER_NAMESPACE = 'Controller\\';
    private const SEPARATOR = '@';

    /** @var string */
    private static $httpMethod = self::GET_METHOD;

    public static function get(string $uri, string $classMethod = ''): void
    {
        self::$httpMethod = self::GET_METHOD;

        self::run($uri, $classMethod);
    }

    public static function post(string $uri, string $classMethod = ''): void
    {
        self::$httpMethod = self::POST_METHOD;
        self::run($uri, $classMethod);
    }

    public static function location(string $fromUri, string $toUrl): void
    {
        self::run($fromUri, $toUrl);
    }

    public static function isHomepage(): bool
    {
        return empty($_GET['uri']);
    }

    /**
     * @param string $uri
     * @param string $value
     *
     * @return mixed
     */
    private static function run(string $uri, string $value)
    {
        $uri = '/' . trim($uri, '/');
        $url = !empty($_GET['uri']) ? '/' . $_GET['uri'] : '/';

        if (preg_match("#^$uri$#", $url, $params)) {
            if (!self::isController($value)) {
                redirect($value);
            } else {
                if ($_SERVER['REQUEST_METHOD'] !== self::$httpMethod) {
                    //throw new InvalidArgumentException(sprintf('HTTP Method Must be %s', self::$httpMethod));
                    (new BaseController)->notFound();
                }

                $ctrlDetails = self::getClassAndMethod($value);
                $class = new $ctrlDetails['class'];
                $method = $ctrlDetails['method'];

                if (method_exists($class, $method)) {
                    foreach ($params as $k => $v) {
                        $params[$k] = str_replace('/', '', $v);
                    }
                    return call_user_func_array(array($class, $method), $params);
                }
            }
            //throw new RuntimeException('Method "' . $method . '" was not found in "' . $class . '" class.');
            (new BaseController)->notFound();
        }
    }

    private static function getClassAndMethod(string $classMethod): array
    {
        $split = explode(self::SEPARATOR, $classMethod);
        $class = self::CONTROLLER_NAMESPACE . $split[0];
        $method = $split[1];

        return ['class' => $class, 'method' => $method];
    }

    private static function isController(string $method): bool
    {
        return strpos($method, self::SEPARATOR) !== false;
    }
}
