<?php

namespace Soloist\Bundle\CalendarBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
                'required'      => false
            ))
            ->add('endDate',         'fw_jquery_date', array(
                'label'         => 'soloist.calendar.event.form.endDate',
                'empty_value'   => '',
                'required'      => false
            ))
            ->add('endTime',         'fw_jquery_time', array(
                'label'         => 'soloist.calendar.event.form.endTime',
                'empty_value'   => '',
                'required'      => false
            ))
            ->add('description',      null,            array(
                'label'         => 'soloist.calendar.event.form.description',
                'required'      => false
            ))
            ->add('place',      'text',            array(
                'label'         => 'soloist.calendar.event.form.place',
                'required'      => false
            ))
            ->add('contactName',     null,             array(
                'label'         => 'soloist.calendar.event.form.contactName',
                'required'      => false
            ))
            ->add('contactPhone',    null,             array(
                'label'         => 'soloist.calendar.event.form.contactPhone',
                'required'      => false
            ))
            ->add('contactPhone',    null,             array(
                'label'         => 'soloist.calendar.event.form.contactPhone2',
                'required'      => false
            ))
            ->add('contactEmail',    null,             array(
                'label'         => 'soloist.calendar.event.form.contactEmail',
                'required'      => false
            ))
            ->add('contactAddress',  null,             array(
                'label'         => 'soloist.calendar.event.form.contactAddress',
                'required'      => false
            ))
            ->add('contactCity',     null,             array(
                'label'         => 'soloist.calendar.event.form.contactCity',
                'required'      => false
            ))
            ->add('contactPostCode', null,             array(
                'label'         => 'soloist.calendar.event.form.contactPostCode',
                'required'      => false
            ))
            ->add('image', 'file', array('data_class' => null, 'required'   => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(
                array(
                    'data_class' => 'Soloist\Bundle\CalendarBundle\Entity\Event'
                )
            );
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
