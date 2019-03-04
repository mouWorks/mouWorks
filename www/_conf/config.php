<?php
// config.php

//Local
if($_SERVER['HTTP_HOST'] == 'localhost'){
    require '_confLocal.php';
}else{
    require '_confProd.php';
}

return array(
    'debug' => DEBUG,
    'mode'  => STAGE,
    'templates.path' => __DIR__ . '/templates',
    'settings' => [
        'displayErrorDetails' => DEBUG,
    ],
);