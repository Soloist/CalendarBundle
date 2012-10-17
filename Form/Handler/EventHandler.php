<?php

namespace Soloist\Bundle\CalendarBundle\Form\Handler;

use Doctrine\ORM\EntityManager;
use FrequenceWeb\Bundle\DashboardBundle\Crud\Form\Handler;
use Soloist\Bundle\CalendarBundle\Entity\Event;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class EventHandler extends Handler
{
    /**
     * @var string
     */
    protected $uploadDir;

    /**
     * @param ContainerInterface $container
     * @param EntityManager      $em
     * @param FormFactory        $factory
     */
    public function __construct(ContainerInterface $container, EntityManager $em, FormFactory $factory)
    {
        $this->uploadDir = $container->getParameter('kernel.root_dir') . '/../web' . Event::UPLOAD_DIR;
        parent::__construct($em, $factory);
    }

    public function create(Form $form, Request $request)
    {
        $form->bind($request);
        if ($form->isValid()) {
            $this->manageImage($form);
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
            $this->manageImage($form, $oldImage);
            $this->em->flush();

            return true;
        }

        return false;
    }

    private function manageImage(Form $form, $old = null)
    {
        $event = $form->getData();
        if (!$event->getImage() instanceof UploadedFile) {
            $event->setImage($old);

            return;
        }

        $file = $form['image']->getData();
        $extension = $file->guessExtension();
        $filename = uniqid() . '-' . $file->getClientOriginalName() . '.' . $extension;
        $file->move($this->uploadDir, $filename);
        $event->setImage($filename);
    }
}
