<?php

namespace App\Controllers;

class PocController extends BaseController
{
    public function getServerTime($request, $response, $args)
    {
        //Allow CORS
        header('Access-Control-Allow-Origin: http://localhost:8080');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');

        $receive = round(microtime(true) * 1000);

        if(($request->getParam('original')) !== null){
            $original =  $request->getParam('original');
            echo $original . '|';
        }

        echo $receive . '|';
        echo round(microtime(true) * 1000);
    }

    /**
     * Just a simple getTime
     */
    public function getTime(){

        $timeStamp = round(microtime(true) * 1000);

        $result = array(
          'status'=> 200,
          'body'=> array('time'=> $timeStamp)
        );

        //Allow CORS
        header('Access-Control-Allow-Origin: http://localhost:8080');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');

        echo json_encode($result, TRUE);
    }













}