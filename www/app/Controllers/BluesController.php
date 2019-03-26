<?php

namespace App\Controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controllers\EventController as Evt;

class BluesController extends EventController
{
    private $container  = null;

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