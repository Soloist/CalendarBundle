<?php

namespace Soloist\Bundle\CalendarBundle\EventListener;

use Symfony\Bundle\FrameworkBundle\Translation\Translator;

use FrequenceWeb\Bundle\DashboardBundle\Menu\Event\Configure;

use Doctrine\ORM\EntityManager;

class DashboardListener
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    private $translator;


    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function onConfigureNewMenu(Configure $event)
    {
        $root = $event->getRoot();
        $root->addChild($this->translator->trans('soloist.calendar.calendar.singular'), array(
            'route'     => 'soloist_admin_calendar'
        ));
        $root->addChild($this->translator->trans('soloist.calendar.event.singular'), array(
            'route'     => 'soloist_admin_event'
        ));
    }

    public function onConfigureTopMenu(Configure $event)
    {
        $nbOrders = $this->em->getRepository('TfhcSiteBundle:Order')->getNonClosedOrders();

        $root = $event->getRoot();
        $root->addChild(
            $this->translator->trans('soloist.calendar.calendar.plural'),
            array('route' => 'soloist_admin_calendar_index')
        );
        $root->addChild(
            $this->translator->trans('soloist.calendar.event.plural'),
            array('route' => 'soloist_admin_event_index')
        );
    }
}
