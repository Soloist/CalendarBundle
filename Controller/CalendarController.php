<?php

namespace Soloist\Bundle\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Soloist\Bundle\CalendarBundle\Entity\Calendar;

class CalendarController extends Controller
{
    /**
     * Show calenders
     *
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $calendars = $em->getRepository('SoloistCalendarBundle:Calendar')->findAll();

        return $this->render('SoloistCalendarBundle:Calendar:index.html.twig');
    }

    public function showAction(Calendar $calendar)
    {
        $events = $factory->getEvents($month);
    }

}
