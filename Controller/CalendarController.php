<?php

namespace Soloist\Bundle\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Soloist\Bundle\CalendarBundle\Entity\Calendar;

class CalendarController extends Controller
{
    /**
     * Show a list of all calendars available
     *
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $calendars = $em->getRepository('SoloistCalendarBundle:Calendar')->findAll();

        return $this->render('SoloistCalendarBundle:Calendar:index.html.twig');
    }

    /**
     * Show a month formated as a calendar
     * Show only events who are avalaible on the precised calendar
     *
     * @param  Calendar $calendar
     * @param  integer   $year
     * @param  integer   $month
     * @return Response
     */
    public function showAction(Calendar $calendar, $year, $month)
    {
        $month = $this->get('calendr')->getMonth($year, $month);

        $this->render('SoloistCalendarBundle:Calendar:show.html.twig', array(
            'month'   => $month,
            'options' => array('id' => $calendar->getId())
        ));
    }

    /**
     * Show a month formated as a calendar
     * Show all events
     *
     * @param  integer $year
     * @param  integer $month
     * @return Response
     */
    public function showAllAction($year, $month)
    {
        $month = $this->get('calendr')->getMonth($year, $month);

        $this->render('SoloistCalendarBundle:Calendar:show.html.twig',array(
            'month'   => $month,
            'options' => array()
        ));
    }

}
