<?php
// Debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__.'/vendor/autoload.php');

use Boldizar\LibraFire\Controller\Router;

// Set the "Not Found" function
Router::notFound(function() {
    echo "
        <div style=\"text-align:center; padding: 4rem;\">
            <h1>404</h1>
            <p>Not Found</p>
    ";
});

// Set the "Not allowed" function
Router::notAllowed(function() {
    echo "
        <div style=\"text-align:center; padding: 4rem;\">
            <h1>405</h1>
            <p>Not Allowed</p>
    ";
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
Router::add('/students/([0-9]*)', function($id) {
    echo "Fetch the student with id: <b>{$id}</b>";
});

// Run the router
Router::run();