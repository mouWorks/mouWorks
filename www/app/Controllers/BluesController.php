<?php

namespace App\Controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controllers\EventController as Evt;

class BluesController extends EventController
{
    private $container  = null;

    //Test
    public $longStringDesc = '3.29.是 1982 年起開業的 ROXY 38 歲生日. 這一個特殊的夜晚. 我們邀請一支精湛表演 藍調搖滾音樂的樂團 WILD ALIBIS 與愛好音樂的您一起歡慶．請朋友們都早一點光臨．00:00 前免費入場．還加送您 4 瓶免費啤酒．';

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getList()
    {
        echo 'Getting Blues Event List';
    }

    public function getEvent()
    {
        echo 'Getting Event';
    }

    public function getCoverPage(Request $request, Response $response){


        //Here config the page Element
        $pageContent = array(
          'pageTitle' =>   'Blues Events Taipei',
          'siteOwnerEmail' => 'mou.wang [at] g.ncu.edu.tw',
          'coverSlogan' => 'Join the party!',
        );

        $data['pageContent'] = $pageContent;
        $data['navBar'] = $this->getNavbar();
        $data['longText'] = $this->longStringDesc;

        return $this->container->view->render($response, 'dance.twig', $data);
    }

    /**
     * Setup the Nav Bar
     */
    public function getNavbar(){

        //1. link, 2.muted? 3.External link ?
       $navBarContent = array(
            'Events' => array(
                 'link'=>'/blues/events',
                 'clickable'=>false,
                 'external'=>false
            ),
           'Classes' => array(
               'link'=>'/blues/classes',
               'clickable'=>false,
               'external'=>false
           ),
           'Bands' => array(
               'link'=>'/blues/bands',
               'clickable'=>false,
               'external'=>false
           ),
           'Blues20Taipei' => array(
               'link'=>'https://zh-tw.facebook.com/blues20taipei/',
               'clickable'=>true,
               'external'=>true
           ),
       );

       return Evt::buildNavBar($navBarContent);
    }
}