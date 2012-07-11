<?php

namespace Soloist\Bundle\CalendarBundle\EventListener;

use Doctrine\ORM\EntityManager;

use Soloist\Bundle\CalendarBundle\Form\Type\BlockSettings\UpcomingEventsType,
    Soloist\Bundle\CalendarBundle\Form\Type\BlockSettings\CalendarType,
    Soloist\Bundle\BlockBundle\EventListener\Event\RequestTypes;

class BlockListener
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function onRequestTypes(RequestTypes $event)
    {
        $event->getManager()->addBlockType('upcoming_events', array(
            'name'          => 'Prochains événements',
            'action'        => 'SoloistCalendarBundle:Default:showUpcomings',
            'settings'      => array('calendar' => null, 'nb' => 5),
            'form'          => new UpcomingEventsType($this->em),
        ));
    }
}
