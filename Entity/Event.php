<?php

namespace Soloist\Bundle\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FrequenceWeb\Bundle\DashboardBundle\Crud\CrudableInterface;
use CalendR\Event\AbstractEvent;

/**
 * Soloist\Bundle\CalendarBundle\Entity\Event
 */
class Event extends AbstractEvent implements CrudableInterface
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var date $startDate
     */
    protected $startDate;

    /**
     * @var time $startTime
     */
    protected $startTime;

    /**
     * @var date $endDate
     */
    protected $endDate;

    /**
     * @var time $endTime
     */
    protected $endTime;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var string $description
     */
    protected $description;

    /**
     * @var string $contactName
     */
    protected $contactName;

    /**
     * @var string $contactEmail
     */
    protected $contactEmail;

    /**
     * @var string $contactAddress
     */
    protected $contactAddress;

    /**
     * @var string $contactCity
     */
    protected $contactCity;

    /**
     * @var string $contactPostCode
     */
    protected $contactPostCode;

    /**
     * Slug
     * @var string
     */
    protected $slug;

    /**
     * @var Calendar $calendar
     */
    protected $calendar;

    /**
     * @var string
     */
    protected $image;

    public function __construct()
    {
        $this->startDate = new \DateTime;
    }

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
     * Set startDate
     *
     * @param date $startDate
     * @return Event
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return date
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set startTime
     *
     * @param time $startTime
     * @return Event
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return time
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endDate
     *
     * @param date $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return date
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set endTime
     *
     * @param time $endTime
     * @return Event
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return time
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Event
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
     * @return Event
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
     * Set contactName
     *
     * @param string $contactName
     * @return Event
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * Get contactName
     *
     * @return string
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     * @return Event
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set contactAddress
     *
     * @param string $contactAddress
     * @return Event
     */
    public function setContactAddress($contactAddress)
    {
        $this->contactAddress = $contactAddress;

        return $this;
    }

    /**
     * Get contactAddress
     *
     * @return string
     */
    public function getContactAddress()
    {
        return $this->contactAddress;
    }

    /**
     * Set contactCity
     *
     * @param string $contactCity
     * @return Event
     */
    public function setContactCity($contactCity)
    {
        $this->contactCity = $contactCity;

        return $this;
    }

    /**
     * Get contactCity
     *
     * @return string
     */
    public function getContactCity()
    {
        return $this->contactCity;
    }

    /**
     * Set contactPostCode
     *
     * @param string $contactPostCode
     * @return Event
     */
    public function setContactPostCode($contactPostCode)
    {
        $this->contactPostCode = $contactPostCode;

        return $this;
    }

    /**
     * Get contactPostCode
     *
     * @return string
     */
    public function getContactPostCode()
    {
        return $this->contactPostCode;
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
     * Set calendar
     * @param Calendar $calendar
     */
    public function setCalendar(Calendar $calendar)
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * Get calendar
     *
     * @return Calendar
     */
    public function getCalendar()
    {
        return $this->calendar;
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
     * {@inheritdoc}
     */
    public function getUid()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getBegin()
    {
        $date = clone $this->startDate;
        if ($time = $this->startTime) {
            $date->setTime($time->format('H'), $time->format('i'));
        }
        return $date;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnd()
    {
        if(!is_null($this->endDate)) {
            $date = clone $this->endDate;
            if (!is_null($date) && $time = $this->endTime) {
                $date->setTime($time->format('H'), $time->format('i'));
            }

            return $date;
        }
        return $this->getBegin();
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

}
