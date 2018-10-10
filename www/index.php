<?php
// index.php - Main entrance for files.

use App\Controllers as Controllers;
use App\Route as Route;

require_once 'vendor/autoload.php';
$config = require_once '_conf/config.php';
$app = new Slim\App($config);

// Twig Related
// Get container
$container = $app->getContainer();
// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('templates', [
        'cache' => false
        //'cache' => 'path/to/cache'
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

    return $view;
};



/*
 * Load Routes
 */
$routeFiles = glob('app/Route/*.php');
foreach ($routeFiles as $file) {
    require_once $file;
}


$app->run();