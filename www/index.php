<?php
// index.php - Main entrance for files.

require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function()
{
    echo '<h1>Hello World Sucker 1234 !!</h1>';
});

$app->get('/blog', function()
{
    echo '<h1>all Blogginaaaa shits</h1>';
});









$app->run();