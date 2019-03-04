<?php

//Environment Variables
$envVars = [
    'LINE_BEARER',
    'CHATROOM_ID',
    'SLACK_CHANNEL_WEBHOOKURL'
];
//Loop thru
foreach($envVars as $envName){
    define($envName, getenv($envName));
}

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