<?php

namespace Soloist\Bundle\CalendarBundle\Controller\Backend;

use FrequenceWeb\Bundle\DashboardBundle\Controller\ORMCrudController;

use Soloist\Bundle\CalendarBundle\Entity\Calendar,
    Soloist\Bundle\CalendarBundle\Form\Type\CalendarType;

/**
 * Admin management for calendars
 */
class CalendarController extends ORMCrudController
{
    /**
     * Return parameters for the dashboard bundle
     *
     * @return array
     */
    protected function getParams()
    {
        return array(
            'display' => array(
                'id'        => array('label' => 'N°'),
                'title'      => array('label' => 'soloist.calendar.calendar.entity.title'),
                'description'   => array('label' => 'soloist.calendar.calendar.entity.description')
            ),
            'prefix'        => 'soloist_backend_calendar',
            'singular'      => 'soloist.calendar.calendar.singular',
            'plural'        => 'soloist.calendar.calendar.plural',
            'repository'    => 'SoloistCalendarBundle:Calendar',
            'form_type'     => new CalendarType,
            'class'         => new Calendar,
            'sortable'       => true
        );
    }

}
