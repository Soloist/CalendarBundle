<?php

namespace Soloist\Bundle\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Soloist\Bundle\CalendarBundle\Entity\Calendar
 */
class Calendar
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var text $description
     */
    private $description;

    /**
     *
     * @var ArrayCollection $events
     */
    private $events;

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
}
