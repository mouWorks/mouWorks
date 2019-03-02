<?php

namespace App\Controllers;

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
    public function Text($text = '可能是地表最強工程師'){

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
    private function _curlPostLineChatRoom(string $chatRoomID, string $authBearer, array $msg)
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
                "Authorization: Bearer " . LINE_BEARER,
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
}