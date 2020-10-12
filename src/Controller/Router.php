<?php
/**
 * @file Contains Boldizar\LibraFire\Controller\Router
 */
namespace Boldizar\LibraFire\Controller;

/**
 * A simple route function for project
 */
class Router {

    /** @var array $routes; */
    private static $routes = [];

    /** @var mixed $notFound; */
    private static $notFound;

    /** @var mixed $notAllowed; */
    private static $notAllowed;

    /**
     * Register a new route
     * @param $expression;
     * @param $function;
     * @param string $method;
     */
    public static function add($expression, $function, string $method = 'get') {
        array_push(self::$routes, [
            'expression' => $expression,
            'function' => $function,
            'method' => $method
        ]);
    }

    /**
     * @param $function;
     */
    public static function notFound($function) {
        self::$notFound = $function;
    }

    /**
     * @param $function
     */
    public static function notAllowed($function) {
        self::$notAllowed = $function;
    }

    /**
     * Run function
     * @param string $basepath;
     */
    public static function run(string $basepath = '/') {

        // Parse the current URL
        $parseUrl = parse_url($_SERVER['REQUEST_URI']);
        $path = array_key_exists('path', $parseUrl) ? $parseUrl['path'] : '/';

        // Get current request method
        $method = $_SERVER['REQUEST_METHOD'];
        $pathMatch = false;
        $routeMatch = false;

        foreach (self::$routes as $route) {
            // Add basepath to matching string
            if ($basepath != '' && $basepath != '/') {
                $route['expression'] = "({$basepath}){$route['expression']}";
            }

            // Add 'find string start' automatically
            $route['expression'] = '^'.$route['expression'];

            // Add 'find string end' automatically
            $route['expression'] = $route['expression'].'$';

            /**
             * @debug
             */
            // print "{$route['expression']}<hr />";

            // Check path match	
            if (preg_match("#{$route['expression']}#", $path, $matches)) {
                $pathMatch = true;

                // Check method match
                if (strtolower($method) == strtolower($route['method'])) {
                    // Remove first element, that's the whole string
                    array_shift($matches);

                    if ($basepath != '' && $basepath != '/') {
                        // Remove basepath
                        array_shift($matches);
                    }

                    call_user_func_array($route['function'], $matches);
                    $routeMatch = true;

                    break;
                }
            }
        }

        // No matching route was found
        if (!$routeMatch) {
            // But the matching path exists
            if ($pathMatch) {
                http_response_code(405);
                if (self::$notAllowed) {
                    call_user_func_array(self::$notAllowed, [
                        'path' => $path, 
                        'method' => $method
                    ]);
                }
            } else {
                http_response_code(404);
                if (self::$notFound) {
                    call_user_func_array(self::$notFound, [
                        'path' => $path
                    ]);
                }
            }
        }
    }
}
