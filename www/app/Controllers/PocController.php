<?php

namespace App\Controllers;

class PocController extends BaseController
{
    public function getServerTime($request, $response, $args)
    {
        $receive = round(microtime(true) * 1000);

        if(($request->getParam('original')) !== null){
            $original =  $request->getParam('original');
            echo $original . '|';
        }

        echo $receive . '|';
        echo round(microtime(true) * 1000);
    }
}