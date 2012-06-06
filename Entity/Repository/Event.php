<?php

namespace Soloist\Bundle\CalendarBundle\Entity\Repository;

use CalendR\Event\Provider\ProviderInterface;

use Doctrine\ORM\EntityRepository;

use Soloist\Bundle\CalendarBundle\Entity\Calendar;

class Event extends EntityRepository implements ProviderInterface
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
                // Start date in period
                $qb->expr()->andX(
                    $qb->expr()->gte('e.startDate', $beginDate),
                    $qb->expr()->lte('e.startDate', $endDate)
                ),
                // End event date in period
                $qb->expr()->andX(
                    $qb->expr()->gte('e.endDate', $beginDate),
                    $qb->expr()->lte('e.endDate', $endDate)
                ),
                // Period in event
                $qb->expr()->andX(
                    $qb->expr()->lte('e.startDate', $beginDate),
                    $qb->expr()->gte('e.endDate', $endDate)
                )
            )
        );


        return $qb->getQuery()->getResult();
    }

    /**
     * Returns $nb events
     *
     * @param null $calendar
     * @param int $nb
     * @return array
     */
    public function findForCalendar($calendar = null, $nb = 5)
    {
        if ($calendar instanceof Calendar) {
            $calendar = $calendar->getId();
        }

        $qb = $this->createQueryBuilder('e')
            ->where('e.startDate > :now')
            ->setParameter('now', date('Y-m-d'))
            ->orderBy('e.startDate')
            ->setMaxResults($nb)
        ;

        if ($calendar) {
            $qb->andWhere('e.calendar = :calendar');
            $qb->setParameter('calendar', $calendar);
        }

        return $qb->getQuery()->getResult();
    }
}
