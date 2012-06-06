<?php

namespace Soloist\Bundle\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Soloist\Bundle\CalendarBundle\Entity\Calendar,
    Soloist\Bundle\CalendarBundle\Entity\Event;

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

        $options = array();
        if(!is_null($calendar)) {
            $options['id'] = $calendar->getId();
        }


        return $this->render('SoloistCalendarBundle:Default:showMonth.html.twig', array(
            'month'     => $month,
            'options'   => $options,
            'calendar'  => $calendar
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
        return $this->render('SoloistCalendarBundle:Default:showEvent.html.twig', array(
            'event'     => $event
        ));
    }


}
