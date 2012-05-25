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
        $root->addChild($this->translator->trans('soloist.calendar.calendar.menu.singular'), array(
            'route'     => 'soloist_admin_calendar_new'
        ));
        $root->addChild($this->translator->trans('soloist.calendar.event.menu.singular'), array(
            'route'     => 'soloist_admin_event_new'
        ));
    }

    public function onConfigureTopMenu(Configure $event)
    {

        $root = $event->getRoot();
        $root->addChild(
            $this->translator->trans('soloist.calendar.calendar.menu.plural'),
            array('route' => 'soloist_admin_calendar_index')
        );
        $root->addChild(
            $this->translator->trans('soloist.calendar.event.menu.plural'),
            array('route' => 'soloist_admin_event_index')
        );
    }
}
