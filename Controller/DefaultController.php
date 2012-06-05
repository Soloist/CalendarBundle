<?php

namespace Soloist\Bundle\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Soloist\Bundle\CalendarBundle\Entity\Calendar;

class DefaultController extends Controller
{
    /**
     * Show a list of all calendars available
     *
     * @return Response
     */
    public function listCalendarsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $calendars = $em->getRepository('SoloistCalendarBundle:Calendar')->findAll();

        return $this->render('SoloistCalendarBundle:Default:listCalendars.html.twig', array(
            'calendars' => $calendars
        ));
    }

    /**
     * Show a month formated as a calendar
     * Show only events who are avalaible on the precised calendar
     *
     * @param  integer   $year
     * @param  integer   $month
     * @param  Calendar $calendar
     * @return Response
     */
    public function showMonthAction($year, $month, Calendar $calendar=null)
    {
        $month = $this->get('calendr')->getMonth($year, $month);


        return $this->render('SoloistCalendarBundle:Default:show.html.twig', array(
            'month' => $month,
            'options' => array('id' => $calendar->getId())
        ));
    }

    /**
     * Show an event
     *
     * @param  Event  $event
     * @return Response
     */
    public function showEventAction(Event $event)
    {
        return $this->render('SoloistCalendarBundle:Default:showEvent.html.twig', array('event' => $event));
    }
}
