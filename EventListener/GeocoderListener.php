<?php

namespace Soloist\Bundle\CalendarBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\UnitOfWork;
use Geocoder\Geocoder;
use Soloist\Bundle\CalendarBundle\Entity\Event;

/**
 * Listens to Doctrine ORM lifecycle events to geocode addresses
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class GeocoderListener implements EventSubscriber
{
    /**
     * @var Geocoder
     */
    private $geocoder;

    /**
     * @param Geocoder $geocoder
     */
    public function __construct(Geocoder $geocoder)
    {
        $this->geocoder = $geocoder;
    }

    /**
     * @param OnFlushEventArgs $args
     */
    public function onFlush(OnFlushEventArgs $args)
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em  = $args->getEntityManager();
        $uow = $em->getUnitOfWork();

        foreach ($uow->getScheduledEntityUpdates() + $uow->getScheduledEntityInsertions() as $entity) {
            if ($entity instanceof Event && array_key_exists('place', $uow->getEntityChangeSet($entity))) {
                $this->processEvent($entity, $em, $uow);
            }
        }
    }

    /**
     * @param Event $event
     */
    public function processEvent(Event $event, EntityManager $em, UnitOfWork $uow)
    {
        $geocode = null;
        try {
            $geocoded = $this->geocoder->geocode($event->getPlace());
            $event->setLatitude($geocoded->getLatitude());
            $event->setLongitude($geocoded->getLongitude());
        } catch (\Exception $e) {
            $event->setLatitude(null);
            $event->setLongitude(null);
        }

        $uow->recomputeSingleEntityChangeSet($em->getClassMetadata(get_class($event)), $event);
    }

    /**
     * @{inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return array('onFlush');
    }
}
