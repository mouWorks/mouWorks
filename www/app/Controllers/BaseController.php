<?php

namespace App\Controllers;

class BaseController
{
    private $_slackHeaderSetup = [ "Content-type: application/json"];

    /**
     * Simple dump Data (w/o Exit)
     * @param $data
     */
    public function d($data){

        echo '<h4>Dumping Data</h4><pre>';
        print_r($data);
        echo '</pre>';
    }

    /**
     * Dump Data w/Exit
     * @param $data
     */
    public function dd($data){
        $this->d($data);
        $this->toss2Slack($data);
        exit();
    }

    /**
     * CURL Sample
     * //curl -X POST -H 'Content-type: application/json' --data '{"text":"this is a test"}' $SLACK_WEBHOOK_URL
     *
     * Toss Error Message 2/Slack
     * @param $data
     */
    public function toss2Slack($data, $channel = SLACK_CHANNEL_WEBHOOKURL)
    {
        try {

            $outputFormat = [
                "text"=> json_encode($data, JSON_UNESCAPED_UNICODE) //Need JSON_UNESCAPED_UNICODE to remain chinese log
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $channel);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($outputFormat));  //Post Fields
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_slackHeaderSetup);

            $server_output = curl_exec($ch);

        }catch(\Exception $e){

            echo 'Exception w/Sending Message to Slack';
            $this->dd($e);
        }

        curl_close ($ch);
    }

    /**
     * Check if data Exist
     */
    public function checkData()
    {
        if(isset(SLACK_CHANNEL_WEBHOOKURL) && SLACK_CHANNEL_WEBHOOKURL != ''){
            echo 'slack channel data exist <br/>';
        }

        if(isset(LINE_BEARER) && LINE_BEARER != ''){
            echo 'Line bearer data exist <br/>';
        }

        if(isset(CHATROOM_ID) && CHATROOM_ID != ''){
            echo 'chatroom ID data exist <br/>';
        }
    }

}//end of Class