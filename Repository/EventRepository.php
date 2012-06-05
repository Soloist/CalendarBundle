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
        $endDate   = sprintf("'%s'", $end->format('Y-m-d'));

        $qb = $this->createQueryBuilder('e');

        if(!empty($options['id']) && is_integer($options['id'])) {
            $qb->where('e.calendar = ' . $options['id']);
        }

        $qb->where(
            $qb->expr()->orX(
                // Period in event
                $qb->expr()->andX(
                    $qb->expr()->lte('e.startDate', $beginDate),
                    $qb->expr()->gte('e.endDate', $endDate)
                ),
                // Event in period
                $qb->expr()->andX(
                    $qb->expr()->gte('e.startDate', $beginDate),
                    $qb->expr()->lt('e.endDate', $endDate)
                ),
                // Event begins during period
                $qb->expr()->andX(
                    $qb->expr()->lt('e.startDate', $endDate),
                    $qb->expr()->gte('e.startDate', $beginDate)
                ),
                // Event ends during period
                $qb->expr()->andX(
                    $qb->expr()->gte('e.endDate', $beginDate),
                    $qb->expr()->lt('e.endDate', $endDate)
                ),
                // Event without endDate
                $qb->expr()->andX(
                    $qb->expr()->gt('e.startDate', $beginDate),
                    $qb->expr()->lt('e.endDate', $beginDate)
                )
            )
        );


        return $qb->getQuery()->getResult();

    }
}
