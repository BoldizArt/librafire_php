<?php
// Debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__.'/vendor/autoload.php');

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Boldizar\LibraFire\Router;
use Boldizar\LibraFire\Controller\Student;

// Set up Twig template engine
$loader = new FilesystemLoader(__DIR__.'/public/templates');
$twig = new Environment($loader, [
    'cache' => __DIR__.'/public/cache',
]);

// Set the "Not Found" function
Router::notFound(function() use ($twig) {
    echo $twig->render('error/404.html.twig');
});

// Set the "Not allowed" function
Router::notAllowed(function() use ($twig) {
    echo $twig->render('error/405.html.twig');
});

// Home page
Router::add('/',function() {
    echo 'Home page';
});

// Students page
Router::add('/students', function() {
    echo 'Students page';
});

// Students page accept only numbers as parameter
// Other characters will result in a 404 error
Router::add('/students/([0-9]*)', function($id) use ($twig) {
    $student = new Student($id);
    $student->show();
});

// Run the router
Router::run();
