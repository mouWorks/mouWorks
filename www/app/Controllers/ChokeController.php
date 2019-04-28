<?php

namespace App\Controllers;

use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;

class ChokeController extends BaseController
{
    //For LINE MESSAGING API
    private $_lineApiUrl = 'https://api.line.me/v2/bot/message/push';

    const TYPE_TEXT = 1;
    const TYPE_IMAGE = 2;

    /**
     * 發送圖片
     *
     * @param $imgUrl
     */
    public function Image(string $imgUrl)
    {
        if(!isset($imgUrl)){
            exit();
        }

        $msg = $this->_buildMsg(self::TYPE_IMAGE, $imgUrl);
        $this->_curlPostLineChatRoom(CHATROOM_ID, LINE_BEARER, $msg);
    }

    /**
     * 發送文字
     *
     *
     * @param string $text
     */
    public function Text($textType, $text = '可能是地表最強工程師'){

        switch($textType){
            case 'bold':
                $text = '*' . $text . '*';
                break;
            case 'italic':
                $text = '_' . $text . '_';
                break;
            case 'highlight':
                $text = "`". $text . "`";
                break;
            case 'betel':
                $text = $this->jiebaText($text);
                break;
            case 'normal':
            default:
                break;
        }

        $msg = $this->_buildMsg(self::TYPE_TEXT, $text);
        $this->_curlPostLineChatRoom(CHATROOM_ID, LINE_BEARER, $msg);
    }

    /**
     * @param $type | String
     * @param $content | Content (text/image)
     */
    private function _buildMsg($type, $content)
    {

        switch($type){
            case self::TYPE_TEXT:

                //Format for Text
                return [
                    [
                        "type"=> "text",
                        "text"=> $content
                    ]
                ];

                break;

            case self::TYPE_IMAGE:

                //Format for Text
                return [
                    [
                        "type"=> "image",
                        "originalContentUrl"=> $content,
                        "previewImageUrl" => $content
                    ]
                ];

                break;

            default:

                break;
        }
    }

    /**
     * @param string $chatRoomID
     * @param string $authBearer
     * @param array $msg
     */
    private function _curlPostLineChatRoom($chatRoomID, $authBearer, $msg)
    {
        $data = [
            'to'=> $chatRoomID,
            'messages'=> $msg
        ];

        //Try PHP simple CURL post
        try {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->_lineApiUrl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  //Post Fields
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0');

            $headers = [
                "Authorization: Bearer " . $authBearer,
                "Content-Type: application/json",
                "Cache-Control: no-cache"
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $server_output = curl_exec($ch);

        }catch(\Exception $e){

            echo 'Exception';
            $this->dd($e);
        }

        curl_close ($ch);
    }


    /**
     * 使用 *財哥風格*
     *
     * @param $text
     * @return string
     */
    public function jiebaText($text)
    {
        ini_set('memory_limit', '2048M'); //it's fucking huge

        Jieba::init(array('mode'=>'default','dict'=>'big'));
        Finalseg::init();

        $seg_list = Jieba::cut($text);
        return implode("...", $seg_list);
    }

    /**
     * 財哥風格 - /tryJieba to try
     */
    public function tryJieba(){

        $data = $this->jiebaText("我想要打Playstation 4");
        self::dd($data);
    }
}