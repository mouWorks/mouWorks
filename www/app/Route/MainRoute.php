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

//$app->get('/', Cont\IndexController::class . ':randWords');

$app->get('/', function ($request, $response, $args) {
    return $this->view->render($response, '/index.twig');
});

$app->get('/blues', Cont\BluesController::class . ':getCoverPage');

$app->get('/blog', function ($request, $response, $args) {
    return $this->view->render($response, 'blog.twig');
});

$app->get('/swing', function()
{
    echo '<h1>Swing thing</h1>';
});

$app->post('/chokeText', function ($request, $response, $args) {

    $data = $request->getParsedBody();
    $choke  = new Cont\ChokeController();
    $choke->Text($data['textType'], $data['text']);
});

//Choker Interface
$app->get('/choker', function ($request, $response, $args) {
//    echo 'eqqwe';exit();
    return $this->view->render($response, 'choker.twig');
});

//L30 Wedding Album
$app->get('/leoWedding', function ($request, $response, $args) {
    return $this->view->render($response, 'leowedding.twig');
});


$app->get('/checkConfig', Cont\BaseController::class . ':checkData');
$app->get('/checkSlack', Cont\BaseController::class . ':checkSlack');

$app->get('/checkEnv', function()
{
    echo 'Now Checking Env Var:[ ';
    echo getenv('TEST_SHIT');
    echo ' ]';
});

$app->get('/checkdb', Cont\EventController::class . ':connectDB');

$app->get('/tryJieba', Cont\ChokeController::class . ':tryJieba');

//$app->get('/checkDB', function()
//{
//    echo 'Now Checking Env Var:[ ';
//    echo getenv('TEST_SHIT');
//    echo ' ]';
//});


//POC - TimeSync Test
//Simple Echo time
$app->get('/time', Cont\PocController::class . ':getTime');

//Testing Time Sync
$app->get('/getServerTime', Cont\PocController::class . ':getServerTime');

$app->get('/timeSync', function ($request, $response, $args) {
    return $this->view->render($response, '/poc/checkTimeSync.twig');
});

//2nd
$app->get('/time2', function ($request, $response, $args) {
    return $this->view->render($response, '/poc/checkTimeSync2.twig');
});

//POC - Class Monitor
$app->get('/student/{name}', function ($request, $response, $args) {
    $data = ['name' => $args['name']];

    return $this->view->render($response,
        '/poc/displayClass.twig', $data);
});

$app->get('/teacher', function ($request, $response, $args) {
    return $this->view->render($response, '/poc/monitorClass.twig');
});

//FIXME - DEBUG Purpose - Only in Local Mode
if(ENV == 'LOCAL'){
    $app->get('/info', function ($request, $response, $args) {
        phpinfo();
//        return $this->view->render($response, '/poc/checkTimeSync.twig');
    });
}//endif
