<?php

namespace Soloist\Bundle\CalendarBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 *
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class ImportType extends AbstractType
{
    /**
     * @{inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('calendar', 'entity', array('class' => 'SoloistCalendarBundle:Calendar'))
            ->add('file', 'file');
    }

    /**
     * @{inheritDoc}
     */
    public function getName()
    {
        return 'soloist_calendar_import';
    }
}
