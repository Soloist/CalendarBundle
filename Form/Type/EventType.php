<?php

namespace Soloist\Bundle\CalendarBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface;

class EventType extends AbstractType
{
    /**
     * Build the form
     * @param  FormBuilderInterface $builder
     * @param  array       $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',            null,            array('label' => 'soloist.calendar.event.form.title'))
            ->add('calendar',         null,            array('label' => 'soloist.calendar.event.form.calendar'))
            ->add('startDate',       'fw_jquery_date', array('label' => 'soloist.calendar.event.form.startDate'))
            ->add('startTime',       'fw_jquery_time', array(
                'label'         => 'soloist.calendar.event.form.startTime',
                'empty_value'   => '',
            ))
            ->add('endDate',         'fw_jquery_date', array(
                'label'         => 'soloist.calendar.event.form.endDate',
                'empty_value'   => '',
            ))
            ->add('endTime',         'fw_jquery_time', array(
                'label'         => 'soloist.calendar.event.form.endTime',
                'empty_value'   => '',
            ))
            ->add('description',      null,            array('label' => 'soloist.calendar.event.form.description'))
            ->add('contactName',     null,             array('label' => 'soloist.calendar.event.form.contactName'))
            ->add('contactEmail',    null,             array('label' => 'soloist.calendar.event.form.contactEmail'))
            ->add('contactAddress',  null,             array('label' => 'soloist.calendar.event.form.contactAddress'))
            ->add('contactCity',     null,             array('label' => 'soloist.calendar.event.form.contactCity'))
            ->add('contactPostCode', null,             array('label' => 'soloist.calendar.event.form.contactPostCode'))
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
