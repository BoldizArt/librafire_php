<?php
// Debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__.'/vendor/autoload.php');

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Set up Twig template engine
$loader = new FilesystemLoader(__DIR__.'/public/templates');
$twig = new Environment($loader, [
    'cache' => __DIR__.'/public/cache',
]);

// This is a simple route function
// Not a good solution, but for this case ok
// It's working
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        echo 'Home page';
        break;
    case '/students' :
    case '/students/' :
        echo 'Students page';
        break;
    default:
        // Check for students request with an id
        if (substr($request, 0, 10) == '/students/') {
            // Explode the request string and create an array
            $params = array_filter(explode('/', $request));
            $params = array_values($params);

            // Check is there an valid id in the request
            if (isset($params[1]) && is_numeric($params[1]) && !isset($params[2])) {
                $id = (int) $params[1];
                echo $twig->render('student.html.twig', [
                    'id' => $id
                ]);
                break;
            }
        }

        http_response_code(404);
        echo 'Page not found';
        break;
}