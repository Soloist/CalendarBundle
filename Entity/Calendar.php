<?php

namespace Soloist\Bundle\CalendarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FrequenceWeb\Bundle\DashboardBundle\Crud\CrudableInterface;
/**
 * Soloist\Bundle\CalendarBundle\Entity\Calendar
 */
class Calendar implements CrudableInterface
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var text $description
     */
    protected $description;

    /**
     *
     * @var ArrayCollection $events
     */
    protected $events;

    /**
     * Title slug
     * @var string
     */
    protected $slug;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Calendar
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return Calendar
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return text
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add an event
     *
     * @param Event $event
     */
    public function addEvent(Event $event)
    {
        $this->events[] = $event;
        $event->setCalendar($this);

        return $this;
    }

    /**
     * Get events
     *
     * @return ArrayCollection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Calendar
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     *
     */
    public function getRouteParams()
    {
        return array(
            'id' => $this->id
        );
    }

    /**
     * Return the title
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }
}
