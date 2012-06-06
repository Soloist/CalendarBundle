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
            'display'    => array(
                'id'          => array('label' => 'N°'),
                'title'       => array(
                    'label' => $translator->trans('soloist.calendar.calendar.entity.title')
                ),
                'description' => array(
                    'type'  => 'longtext',
                    'label' => $translator->trans('soloist.calendar.calendar.entity.description')
                )
            ),
            'prefix'     => 'soloist_calendar_admin_calendar',
            'singular'   => $translator->trans('soloist.calendar.calendar.singular'),
            'plural'     => $translator->trans('soloist.calendar.calendar.plural'),
            'repository' => 'SoloistCalendarBundle:Calendar',
            'form_type'  => new CalendarType,
            'class'      => new Calendar,
            'sortable'   => true,
            'object_actions'    => array(
                'manage_image' => array(
                    'label' => $translator->trans('soloist.calendar.admin.eventManagement'),
                    'route' => 'soloist_calendar_admin_event_by_calendar',
                )
            ),
        );
    }

    public function showEventsAction(Calendar $calendar)
    {
        $this->addBaseBreadcrumb(false);
        return $this->render('FrequenceWebDashboardBundle:Crud:index.html.twig', array(
            'objects'       => $calendar->getEvents(),
            'currentSort'   => null
        ));
    }

}
