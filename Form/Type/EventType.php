<?php

namespace Soloist\Bundle\CalendarBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilder;

class CalendarType extends AbstractType
{
    /**
     * Build the form
     * @param  FormBuilder $builder
     * @param  array       $options
     *
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'soloist.calendar.event.form.title'))
            ->add('description', null, array('label' => 'soloist.calendar.event.form.description'))
            ->add('startDate', null, array('label' => 'soloist.calendar.event.form.startDate'))
            ->add('startTime', null, array('label' => 'soloist.calendar.event.form.startTime'))
            ->add('endDate', null, array('label' => 'soloist.calendar.event.form.endDate'))
            ->add('endTime', null, array('label' => 'soloist.calendar.event.form.endTime'))
            ->add('contactName', null, array('label' => 'soloist.calendar.event.form.contactName'))
            ->add('contactEmail', null, array('label' => 'soloist.calendar.event.form.contactEmail'))
            ->add('contactAddress', null, array('label' => 'soloist.calendar.event.form.contactAddress'))
            ->add('contactCity', null, array('label' => 'soloist.calendar.event.form.contactCity'))
            ->add('contactPostCode', null, array('label' => 'soloist.calendar.event.form.contactPostCode'))
            ->add('calendar', null, array('label' => 'soloist.calendar.event.form.calendar'))
        ;
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'soloist_event_type';
    }

}
