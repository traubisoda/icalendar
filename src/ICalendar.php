<?php

namespace ICalendar;

use \DateTime;
use \Exception;

class ICalendar
{
	/**
	 * Product identifier
	 * @var string
	 */
	protected $prodId;

	/**
	 * Version
	 * @var string
	 */
	protected $version = '2.0';

	/**
	 * Calendar scale
	 * @var string
	 */
	protected $calscale = 'GREGORIAN';

	/**
	 * Method type
	 * @var string
	 */
	protected $method = 'REQUEST';

	/**
	 * Start date of event in 
	 * @var DateTime
	 */
	protected $startDate;

	/**
	 * End date of event
	 * @var DateTime
	 */
	protected $endDate;

	/**
	 * Organizer of event
	 * @var string
	 */
	protected $organizer;

	/**
	 * Unique identifier for event
	 * @var string
	 */
	protected $uuid;

	/**
	 * Attendees for event
	 * @var array
	 */
	protected $attendees = [];

	/**
	 * Description of event
	 * @var string
	 */
	protected $description;

	/**
	 * Location of event
	 * @var string
	 */
	protected $location;

	/**
	 * Sequence number, 0 by default
	 * @var integer
	 */
	protected $sequence = 0;

	/**
	 * Summary of event
	 * @var [type]
	 */
	protected $summary;

	/**
	 * Transparency of event
	 * https://tools.ietf.org/html/rfc5545#section-3.8.2.7
	 * @var string
	 */
	protected $transp = 'OPAQUE';

	/**
	 * Set unique identifier in constructor
	 */
	public function __construct() {
		$this->uuid = uniqid();
	}

    /**
     * Gets the value of prodId.
     *
     * @return mixed
     */
    public function getProdId()
    {
        return $this->prodId;
    }

    /**
     * Sets the value of prodId.
     *
     * @param mixed $prodId the prodId
     *
     * @return self
     */
    public function setProdId($prodId)
    {
        $this->prodId = $prodId;

        return $this;
    }

    /**
     * Gets the value of version.
     *
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Sets the value of version.
     *
     * @param mixed $version the version
     *
     * @return self
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Gets the value of calscale.
     *
     * @return mixed
     */
    public function getCalscale()
    {
        return $this->calscale;
    }

    /**
     * Sets the value of calscale.
     *
     * @param mixed $calscale the calscale
     *
     * @return self
     */
    public function setCalscale($calscale)
    {
        $this->calscale = $calscale;

        return $this;
    }

    /**
     * Gets the value of method.
     *
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Sets the value of method.
     *
     * @param mixed $method the method
     *
     * @return self
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Gets the value of startDate.
     *
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Sets the value of startDate.
     *
     * @param mixed $startDate the start date
     *
     * @return self
     */
    public function setStartDate($startDate)
    {
    	if(gettype($startDate) === 'string') {
    		$startDate = new DateTime($startDate);
    	}

        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Gets the value of endDate.
     *
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Sets the value of endDate.
     *
     * @param mixed $endDate the end date
     *
     * @return self
     */
    public function setEndDate($endDate)
    {
    	if(gettype($endDate) == 'string') {
    		$endDate = new DateTime($endDate);
    	}
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Gets the value of organizer.
     *
     * @return mixed
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * Sets the value of organizer.
     *
     * @param mixed $organizer the organizer
     *
     * @return self
     */
    public function setOrganizer($organizer)
    {
        $this->organizer = $organizer;

        return $this;
    }

    /**
     * Gets the value of uuid.
     *
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid . '@' . explode('@', $this->organizer)[1];
    }

    /**
     * Sets the value of uuid.
     *
     * @param mixed $uuid the uuid
     *
     * @return self
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Gets the value of attendees.
     *
     * @return mixed
     */
    public function getAttendees()
    {
        return $this->attendees;
    }

    /**
     * Sets the value of attendees.
     *
     * @param array $attendees the attendees
     *
     * @return self
     */
    public function setAttendees($attendees)
    {
        $this->attendees = $attendees;

        return $this;
    }

    /**
     * Set single attendee
     * @param string $attendee the attendee
     */
    public function addAttendee($attendee)
    {
        $this->attendees[] = $attendee;

        return $this;
    }

    /**
     * Gets the value of description.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the value of description.
     *
     * @param mixed $description the description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets the value of location.
     *
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the value of location.
     *
     * @param mixed $location the location
     *
     * @return self
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Gets the value of sequence.
     *
     * @return mixed
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Sets the value of sequence.
     *
     * @param integer
     *
     * @return self
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * Gets the value of summary.
     *
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Sets the value of summary.
     *
     * @param mixed $summary the summary
     *
     * @return self
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Gets the value of transp.
     *
     * @return mixed
     */
    public function getTransp()
    {
        return $this->transp;
    }

    /**
     * Sets the value of transp.
     *
     * @param mixed $transp the transp
     *
     * @return self
     */
    public function setTransp($transp)
    {
        $this->transp = $transp;

        return $this;
    }

    /**
     * Escapes string
     * @param  string $string String to be escapced
     * @return string         Escaped string
     */
    private function escape($string) 
    {
    	return preg_replace('/([\,;])/', '\\\$1', $string);
    }

    public function getCalendar() 
    {
    	// Check for required fields
    	if(empty($this->organizer) || empty($this->startDate) || empty($this->endDate)) {
    		throw new Exception('Please set organizer, start and end dates!');
    	}

    	$calendar = "BEGIN:VCALENDAR" . "\r\n";
    	$calendar .= "PRODID:-//" . $this->getProdId() . "//EN\r\n";
    	$calendar .= "VERSION:" . $this->getVersion() . "\r\n";
    	$calendar .= "CALSCALE:" . $this->getCalscale() . "\r\n";
    	$calendar .= "METHOD:" . $this->getMethod() . "\r\n";
    	$calendar .= "BEGIN:VEVENT" . "\r\n";
    	$calendar .= "DTSTART:" . $this->getStartDate()->format('Ymd\THis\Z') . "\r\n";
    	$calendar .= "DTEND:" . $this->getEndDate()->format('Ymd\THis\Z') . "\r\n";
    	$calendar .= "DTSTAMP:" . date('Ymd\THis\Z') . "\r\n";
    	$calendar .= "ORGANIZER:mailto:" . $this->getOrganizer() . "\r\n";
    	$calendar .= "UID:" . $this->getUuid() . "\r\n";
    	foreach($this->getAttendees() as $attendee) {
    		$calendar .= "ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN=" . $attendee. ";X-NUM-GUESTS=0:mailto:" . $attendee . "\r\n";
    	}
    	$calendar .= "CREATED:" . date('Ymd\THis\Z') . "\r\n";
    	$calendar .= "DESCRIPTION:" . $this->escape($this->getDescription()) . "\r\n";
    	$calendar .= "LAST-MODIFIED:" . date('Ymd\THis\Z') . "\r\n";
    	$calendar .= "LOCATION:" . $this->escape($this->getLocation()) . "\r\n";
    	$calendar .= "SEQUENCE:" . $this->getSequence() . "\r\n";
    	$calendar .= "STATUS:CONFIRMED" . "\r\n";
    	$calendar .= "SUMMARY:" . $this->escape($this->getSummary()) . "\r\n";
    	$calendar .= "TRANSP:" . $this->getTransp() . "\r\n";
    	$calendar .= "END:VEVENT"  . "\r\n";
    	$calendar .= "END:VCALENDAR" . "\r\n";

    	return $calendar;
    }

}