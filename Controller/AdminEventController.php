<?php

namespace Soloist\Bundle\CalendarBundle\Controller;

use FrequenceWeb\Bundle\DashboardBundle\Controller\ORMCrudController;
use Soloist\Bundle\CalendarBundle\Entity\Calendar;
use Soloist\Bundle\CalendarBundle\Entity\Event;
use Soloist\Bundle\CalendarBundle\Form\Handler\EventHandler;
use Soloist\Bundle\CalendarBundle\Form\Type\EventType;
use Soloist\Bundle\CalendarBundle\Form\Type\ImportType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Admin management for events
 */
class AdminEventController extends ORMCrudController
{
    public function displayImportFormAction()
    {
        $form = $this->createForm(new ImportType);

        return $this->render(
            'SoloistCalendarBundle:AdminEvent:displayImportForm.html.twig',
            array('form' => $form->createView())
        );
    }

    public function importAction(Request $request)
    {
        $form = $this->createForm(new ImportType);
        $form->bind($request);
        if ($form->isValid()) {
            $calendar = $this->getDoctrine()->getRepository('SoloistCalendarBundle:Calendar')
                ->find($form['calendar']->getData());

            $this->get('soloist.calendar.importer.phpexcel')->import(
                $calendar,
                $form['file']->getData()->getPathname()
            );

            $this->get('session')->getFlashbag()->add('success', 'Evenements importés avec succès');

            return $this->redirect($this->generateUrl('soloist_calendar_admin_event_index'));
        }

        return $this->render(
            'SoloistCalendarBundle:AdminEvent:displayImportForm.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * Return parameters for the dashboard bundle
     *
     * @return array
     */
    protected function getParams()
    {
        $translator = $this->get('translator');

        return array(
            'display'           => array(
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
            'prefix'            => 'soloist_calendar_admin_event',
            'singular'          => $translator->trans('soloist.calendar.event.singular'),
            'plural'            => $translator->trans('soloist.calendar.event.plural'),
            'repository'        => 'SoloistCalendarBundle:Event',
            'form_type'         => new EventType,
            'class'             => new Event,
            'sortable'          => true,
            'object_actions'    => array(),
            'indexTemplate'     => 'SoloistCalendarBundle:AdminEvent:index.html.twig'
        );
    }

    public function showByCalendarAction(Calendar $calendar)
    {
        $this->addBaseBreadcrumb(false);

        return $this->render('FrequenceWebDashboardBundle:Crud:index.html.twig', array(
            'objects'       => $calendar->getEvents(),
            'currentSort'   => null
        ));
    }

    protected function getFormHandler()
    {
        return new EventHandler($this->container, $this->getDoctrine()->getManager(), $this->get('form.factory'));
    }
}
