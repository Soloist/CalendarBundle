<?php

namespace Soloist\Bundle\CalendarBundle\Controller;

use FrequenceWeb\Bundle\DashboardBundle\Controller\ORMCrudController;

use Soloist\Bundle\CalendarBundle\Entity\Event,
    Soloist\Bundle\CalendarBundle\Form\Type\EventType;

/**
 * Admin management for events
 */
class AdminEventController extends ORMCrudController
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
            'display'     => array(
                'id'        => array('label' => 'N°'),
                'startDate'   => array(
                    'type'  => 'date',
                    'label' => $translator->trans('soloist.calendar.event.entity.startDate')
                ),
                'title'       => array(
                    'label' => $translator->trans('soloist.calendar.event.entity.title')
                ),
                'description' => array(
                    'type'  => 'longtext',
                    'label' => $translator->trans('soloist.calendar.event.entity.description')
                ),
            ),
            'prefix'     => 'soloist_calendar_admin_event',
            'singular'   => $translator->trans('soloist.calendar.event.singular'),
            'plural'     => $translator->trans('soloist.calendar.event.plural'),
            'repository' => 'SoloistCalendarBundle:Event',
            'form_type'  => new EventType,
            'class'      => new Event,
            'sortable'   => true
        );
    }
}
