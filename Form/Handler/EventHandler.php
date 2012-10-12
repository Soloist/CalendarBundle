<?php

namespace Soloist\Bundle\CalendarBundle\Form\Handler;

use FrequenceWeb\Bundle\DashboardBundle\Crud\Form\Handler;
use Soloist\Bundle\CalendarBundle\Entity\Event;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class EventHandler extends Handler
{
    public function create(Form $form, Request $request)
    {
        $form->bind($request);
        if ($form->isValid()) {
            $this->manageImage($form->getData());
            $this->em->persist($form->getData());
            $this->em->flush();

            return true;
        }

        return false;
    }

    public function update(Form $form, Request $request)
    {
        $oldImage = $form->getData()->getImage();
        $form->bind($request);
        if ($form->isValid()) {
            $this->manageImage($form->getData(), $oldImage);
            $this->em->flush();

            return true;
        }

        return false;
    }

    private function manageImage(Event $event, $old = null)
    {

    }
}
