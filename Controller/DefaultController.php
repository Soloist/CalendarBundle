<?php

namespace Soloist\Bundle\CalendarBundle\Controller;

use Soloist\Bundle\CalendarBundle\Entity\Calendar;
use Soloist\Bundle\CalendarBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * Show a list of all calendars available
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listCalendarsAction()
    {
        $calendars = $this->getDoctrine()->getManager()->getRepository('SoloistCalendarBundle:Calendar')->findAll();

        return $this->render('SoloistCalendarBundle:Default:listCalendars.html.twig', array('calendars' => $calendars));
    }

    /**
     * Show a month formated as a calendar
     * Show only events who are avalaible on the precised calendar
     *
     * @param int      $year
     * @param int      $month
     * @param Calendar $calendar
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showMonthAction($year, $month, Calendar $calendar=null)
    {
        $month = $this->get('calendr')->getMonth($year, $month);

        $options = array();
        if (null !== $calendar) {
            $options['id'] = $calendar->getId();
        }

        return $this->render(
            'SoloistCalendarBundle:Default:showMonth.html.twig',
            array(
                'month'     => $month,
                'options'   => $options,
                'calendar'  => $calendar
            )
        );
    }

    /**
     * Show an event
     *
     * @param Event $event
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showEventAction(Event $event)
    {
        return $this->render('SoloistCalendarBundle:Default:showEvent.html.twig', array('event' => $event));
    }

    /**
     * @param Calendar $calendar
     * @param int      $nb
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showUpcomingsAction($calendar = null, $nb)
    {
        $events = $this->getDoctrine()->getRepository('SoloistCalendarBundle:Event')->findForCalendar($calendar, $nb);

        return $this->render('SoloistCalendarBundle:Default:showUpcomings.html.twig', array('events' => $events));
    }

    /**
     * @param Calendar $calendar
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showCalendarAction(Calendar $calendar)
    {
        $month = $this->get('calendr')->getMonth(date('Y'), date('n'));

        return $this->render(
            'SoloistCalendarBundle:Default:showCalendar.html.twig',
            array(
                'options'   => array('id' => $calendar->getId()),
                'calendar'  => $calendar,
                'month'     => $month
            )
        );
    }

}
