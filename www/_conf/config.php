<?php
// config.php
//require '_conf.php';
//require '_confProd.php';

//Local
if($_SERVER['HTTP_HOST'] == 'localhost'){
    require '_conf.php';
}else{
    require '_confProd.php';
}

define('SLIM_ROOT', __DIR__);

return array(
    'debug' => true,
    'mode'  => 'production',
    'templates.path' => __DIR__ . '/templates',
    'settings' => [
        'displayErrorDetails' => true,
    ],
);