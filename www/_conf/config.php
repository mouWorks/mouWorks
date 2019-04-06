<?php

//Environment Variables
$envVars = [
    'LINE_BEARER',
    'CHATROOM_ID',
    'SLACK_CHANNEL_WEBHOOKURL',
    'DB_NAME',
    'DB_PASS'
];
//Loop thru
foreach($envVars as $envName){
    define($envName, getenv($envName));
}

if(preg_match('/localhost/i', $_SERVER['HTTP_HOST'])){
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