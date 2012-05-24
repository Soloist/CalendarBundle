<?php

namespace Soloist\Bundle\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SoloistCalendarBundle:Default:index.html.twig', array('name' => $name));
    }
}
