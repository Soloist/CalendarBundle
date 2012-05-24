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
            ->add('title', null, array('label' => 'soloist.calendar.calendar.form.title'))
            ->add('description', null, array('label' => 'soloist.calendar.calendar.form.description'))
        ;
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'soloist_calendar_type';
    }

}
