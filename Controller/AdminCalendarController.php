<?php

namespace Soloist\Bundle\CalendarBundle\Controller;

use FrequenceWeb\Bundle\DashboardBundle\Controller\ORMCrudController;

use Soloist\Bundle\CalendarBundle\Entity\Calendar,
    Soloist\Bundle\CalendarBundle\Form\Type\CalendarType;

/**
 * Admin management for calendars
 */
class AdminCalendarController extends ORMCrudController
{
    /**
     * Return parameters for the dashboard bundle
     *
     * @return array
     */
    protected function getParams()
    {
        $translator = $this->get('translator');

        return array(
            'display' => array(
                'id'        => array('label' => 'N°'),
                'title'      => array(
                    'label' => $translator->trans('soloist.calendar.calendar.entity.title')
                ),
                'description'   => array(
                    'label' => $translator->trans('soloist.calendar.calendar.entity.description')
                )
            ),
            'prefix'        => 'soloist_backend_calendar',
            'singular'      => $translator->trans('soloist.calendar.calendar.singular'),
            'plural'        => $translator->trans('soloist.calendar.calendar.plural'),
            'repository'    => 'SoloistCalendarBundle:Calendar',
            'form_type'     => new CalendarType,
            'class'         => new Calendar,
            'sortable'       => true
        );
    }

}
