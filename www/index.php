<?php
// index.php - Main entrance for files.
define('DIR_VENDOR', __DIR__.'/vendor/');
define('ENV_PATH', __DIR__.'/_conf/');

// Autoloader
if (file_exists(DIR_VENDOR . 'autoload.php')) {
    require_once(DIR_VENDOR . 'autoload.php');
}

if ( ! file_exists(ENV_PATH . '.env')) {
    echo 'Missing ENV file. Exit @index.php';
    exit();
}

$dotEnv = Dotenv\Dotenv::create(ENV_PATH);
$dotEnv->load();

$config = require_once '_conf/config.php';

$c = new \Slim\Container($config);

$app = new Slim\App($c);

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

//Display Error Template when in PROD env
if(ENV == 'PROD'){
    //Override the default Not Found Handler
    $container['notFoundHandler'] = function ($c) {
        return function ($request, $response) use ($c) {
            return $c['view']->render($response->withStatus(404), '/404.html', [
                "desc" => "Well Your page is not found. Sorry."
            ]);
        };
    };

//Define Error here
    $container['errorHandler'] = function ($c) {
        return function ($request, $response, $exception) use ($c) {

            //Maybe toss to slack here
            $base = new \App\Controllers\BaseController();
            $base->toss2Slack($exception);

            return $c['view']->render($response->withStatus(500), '/500.html', [
                "desc" => "Well Something Wrong with Server, Sorry"
            ]);
        };
    };
}//endif





/*
 * Load Routes
 */
$routeFiles = glob('app/Route/*.php');
foreach ($routeFiles as $file) {
    require_once $file;
}

$app->run();
