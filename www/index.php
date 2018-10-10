<?php
// index.php - Main entrance for files.

require 'vendor/autoload.php';
$config = require '_conf/config.php';
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

// Render Twig template in route
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->view->render($response, 'profile.html', [
        'name' => $args['name']
    ]);
})->setName('profile');



$app->get('/', function()
{
//    $loader = new Twig_Loader_String();
//
//    $twig = new Twig_Environment($loader);
//
//    echo $twig->render('Hello {{ name }}!', array('name' => 'Asika'));
//

    echo '<h1>HelloWorld, Bro</h1>';
});

$app->get('/blog', function()
{
    echo '<h1>This is the blog site</h1>';
});

$app->get('/swing', function()
{
    echo '<h1>Swing thing</h1>';
});


$app->get('/blues', function()
{
    echo '<h1>Blues thing</h1>';
});

$app->run();



$app->run();