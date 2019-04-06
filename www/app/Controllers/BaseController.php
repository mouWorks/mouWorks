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
        if(defined('SLACK_CHANNEL_WEBHOOKURL')){
            echo 'slack channel data exist <br/>';
        }else{
            echo 'Slack Channel Webhook: error';
        }

        if(defined('LINE_BEARER')){
            echo 'line bearer data exist <br/>';
        }else{
            echo 'line bearer: error';
        }

        if(defined('CHATROOM_ID')){
            echo 'chatroom data exist <br/>';
        }else{
            echo 'chatroom: error';
        }
    }

    /**
     * Check if Slack would work
     */
    public function checkSlack(){

        $data = ['text'=> 'Huston, we are testing slack'];
        $this->toss2Slack($data);
    }

    //Not yet complete
    public function connectDB(){

        $serverName = 'mariadb'; //Here we use Docker-compose name (defined at Docker-Compose)
        $username = "root";
        $password = DB_PASS;
        $dbname = DB_NAME;

        $serverPort = 3306;
        $dsn = "mysql:host=".$serverName.";dbname=".$dbname.";port=".$serverPort;
        $conn = new \PDO($dsn, $username, $password);

        foreach ($conn->query('SELECT * from dance') as $row) {
            print_r($row); //你可以用 echo($GLOBAL); 来看到这些值
        }

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
}//end of Class