<?php
// Debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__.'/vendor/autoload.php');

use Dotenv\Dotenv;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Boldizar\LibraFire\Router;
use Boldizar\LibraFire\Model\StudentModel;
use Boldizar\LibraFire\Controller\Student;

// Load the .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Set up Twig template engine
$loader = new FilesystemLoader(__DIR__.'/public/templates');
$twig = new Environment($loader, [
    'cache' => __DIR__.'/public/cache',
]);

// Set the "Not Found" function
Router::notFound(function() use ($twig) {
    echo $twig->render('error/error.html.twig', [
        'title' => 404,
        'text' => 'Not Found'
    ]);
});

// Set the "Not allowed" function
Router::notAllowed(function() use ($twig) {
    echo $twig->render('error/error.html.twig', [
        'title' => 405,
        'text' => 'Not Allowed'
    ]);
});

// Home page
Router::add('/',function() use ($twig) {
    echo $twig->render('home.html.twig');
});

// Students page
Router::add('/students',function() use ($twig) {
    $model = new StudentModel();
    $students = $model->fetchAll();
    echo $twig->render('students.html.twig', [
        'students' => $students
    ]);
});

// Students page accept only numbers as parameter
// Other characters will result in a 404 error
Router::add('/students/([0-9]*)', function($id) use ($twig) {
    $student = new Student($id);
    $student->render();
});

// Run the router
Router::run();
