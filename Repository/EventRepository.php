<?php

namespace Soloist\Bundle\CalendarBundle\Repository;

use CalendR\Event\Provider\ProviderInterface;
use Doctrine\ORM\EntityRepository,
    Doctrine\ORM\Query\Expr;


class EventRepository extends EntityRepository implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getEvents(\DateTime $begin, \DateTime $end, array $options = array())
    {
        $beginDate = sprintf("'%s'", $begin->format('Y-m-d'));
        $beginTime = sprintf("'%s'", $begin->format('H:i'));
        $endDate   = sprintf("'%s'", $end->format('Y-m-d'));
        $endTime   = sprintf("'%s'", $end->format('H:i'));

        $qb = $this->createQueryBuilder('e');

        if(!empty($options['id']) && is_integer($options['id'])) {
            $qb->innerJoin('e.calendar', 'c', Expr\Join::ON, 'c.id = '.$options['id']);
        }

        $qb->where(
            $qb->expr()->andX(
                $qb->expr()->gt('e.startDate', $beginDate),
                $qb->expr()->gt('e.startTime', $beginTime),
                $qb->expr()->lt('e.endDate', $endDate),
                $qb->expr()->lt('e.endTime', $endTime)
            )
        );

        return $qb->getQuery()->getResult();

    }
}
