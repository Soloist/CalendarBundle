<?php

namespace Soloist\Bundle\CalendarBundle\Controller\Backend;

/**
 * Admin management for events
 */
class EventController extends ORMCrudController
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
                'startDate'     => array(
                    'label' => $translator->trans('soloist.calendar.event.entity.startDate')
                ),
                'title'      => array(
                    'label' => $translator->trans('soloist.calendar.event.entity.title')
                ),
                'description'   => array(
                    'label' => $translator->trans('soloist.calendar.event.entity.description')
                ),
            ),
            'prefix'        => 'soloist_backend_event',
            'singular'      => $translator->trans('soloist.calendar.event.singular'),
            'plural'        => $translator->trans('soloist.calendar.event.plural'),
            'repository'    => 'SoloistCalendarBundle:Event',
            'form_type'     => new EventType,
            'class'         => new Event,
            'sortable'       => true
        );
    }
}
