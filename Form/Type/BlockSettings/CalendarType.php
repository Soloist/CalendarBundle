<?php

namespace Soloist\Bundle\CalendarBundle\Form\Type\BlockSettings;

use Doctrine\ORM\EntityManager;

use Soloist\Bundle\CalendarBundle\Entity\Calendar;

use Symfony\Component\Form\DataTransformerInterface,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\AbstractType;

class CalendarType extends AbstractType implements DataTransformerInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->appendClientTransformer($this)
            ->add('calendar', 'entity', array(
                'class'  => 'SoloistCalendarBundle:Calendar',
            ))
        ;
    }

    /**
     * @{inheritDoc}
     */
    public function transform($value)
    {
        if (isset($value['calendar']) && is_int($value['calendar'])) {
            $value['calendar'] = $this->em->find('SoloistCalendarBundle:Calendar', $value['calendar']);
        }

        return $value;
    }

    /**
     * @{inheritDoc}
     */
    public function reverseTransform($value)
    {
        if (isset($value['calendar']) && $value['calendar'] instanceof Calendar) {
            $value['calendar'] = $value['calendar']->getId();
        }

        return $value;
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'soloist_calendar_calendar_block_settings';
    }
}
