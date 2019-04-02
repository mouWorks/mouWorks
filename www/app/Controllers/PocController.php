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

    /**
     * Just a simple getTime
     */
    public function getTime(){

        $result = array(
          'status'=> 200,
          'body'=> array('time'=> time())
        );

        //echo $result;
        echo json_encode($result, TRUE);
    }

}