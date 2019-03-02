<?php

use \App\Controllers as Cont;

$app->get('/test', Cont\BluesController::class . ':getList');


// Render Twig template in route
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->view->render($response, 'profile.html', [
        'name' => $args['name']
    ]);
})->setName('profile');

// Render Twig template in route
//$app->get('/', function ($request, $response, $args) {
//    return $this->view->render($response, 'index.twig', [
////        'name' => $args['name']
//    ]);
//})->setName('index');

$app->get('/', Cont\IndexController::class . ':randWords');

// Render Twig template in route
$app->get('/blues', function ($request, $response, $args) {
    return $this->view->render($response, 'overview.twig', [
//        'name' => $args['name']
    ]);
})->setName('index');

$app->get('/blog', function()
{
    echo '<h1>This is the blog site</h1>';
});

$app->get('/swing', function()
{
    echo '<h1>Swing thing</h1>';
});

$app->get('/choke/text/{text}', function ($request, $response, $args) {

    $choke  = new Cont\ChokeController();
    $choke->Text($args['text']);
});

//Choker Interface
$app->get('/choker', function ($request, $response, $args) {
    return $this->view->render($response, 'choker.twig');
})->setName('index');

