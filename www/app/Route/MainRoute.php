<?php

use \App\Controllers as Cont;
use \App\Components as Comp;

if (strpos($_SERVER['SERVER_NAME'], 'localhost') !== false) {
    define('BASE_PATH', 'localhost:8080/index.php');
}else{
    define('BASE_PATH', '');
}

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

$app->get('/choke/text/{text}', function ($request, $response, $args) {

    $choke  = new Cont\ChokeController();
    $choke->Text($args['text']);
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



//M1GA - JobSearch Project

//Display EntryPage - Explain && Select Char
$app->get('/m1ga', Cont\JobSearchController::class . ':index');

//Display SelectionPage
$app->get('/m1ga/{questionNumber}', function ($request, $response, $args) {
    $pageName = Comp\M1GAComp::getQuestionTwig($args['questionNumber']);
    return $this->view->render($response, "/m1ga/{$pageName}.twig");
});

//1. Char Page (Rookie/Senior)
//$app->get('/m1ga/q1/{status}', Cont\JobSearchController::class . ':index');

//Questions Page
//1. Select User
//2. Select JobType
//3. Select Pay Range
//4. Select Quality Index
$app->get('/m1ga/question/{number}/{answer}', function ($request, $response, $args) {
    $jS  = new Cont\JobSearchController();
    $jS->showQuestion($args['number'], $args['answer']);
});

//

//$app->get('/jobSearch', Cont\JobSearchController::class . ':query');


$app->get('/m1ga/jobSearch/[{queryString}]', function ($request, $response, $args) {

    $jS  = new Cont\JobSearchController();

    $queryString = '';
    if(isset($args['queryString'])){
        $queryString = $args['queryString'];
    }
    $jS->query($queryString);
});