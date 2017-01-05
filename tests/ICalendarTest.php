<?php
require __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use ICalendar\ICalendar;

class ICalendarTest extends TestCase
{
	protected $calendar;

	public function setUp() 
	{
		$this->calendar = (new ICalendar())
			->setStartDate(new DateTime())
			->setEndDate(new DateTime())
			->setOrganizer('mail@example.com');
	}

	public function testProdId() 
	{
		$this->calendar->setProdId('Calendar Inc');

		$this->assertEquals('Calendar Inc', $this->calendar->getProdId());
		$this->assertContains("PRODID:-//Calendar Inc//EN\r\n", $this->calendar->getCalendar());
	}

	public function testVersion() 
	{
		$this->calendar->setVersion('2.0');

		$this->assertEquals('2.0', $this->calendar->getVersion());
		$this->assertContains("VERSION:2.0\r\n", $this->calendar->getCalendar());
	}

	public function testCalscale() 
	{
		$this->calendar->setCalscale('GREGORIAN');

		$this->assertEquals('GREGORIAN', $this->calendar->getCalscale());
		$this->assertContains("CALSCALE:GREGORIAN\r\n", $this->calendar->getCalendar());
	}

	public function testRequest() 
	{
		$this->calendar->setMethod('REQUEST');

		$this->assertEquals('REQUEST', $this->calendar->getMethod());
		$this->assertContains("METHOD:REQUEST\r\n", $this->calendar->getCalendar());
	}

	public function testStartDate() 
	{
		$date = new DateTime(date('Y-m-d'));
		$this->calendar->setStartDate(date('Y-m-d'));

		$this->assertEquals($date, $this->calendar->getStartDate());
		$this->assertContains("DTSTART:" . $date->format('Ymd\THis\Z') . "\r\n", $this->calendar->getCalendar());
	}

	public function testEndDate() 
	{
		$date = new DateTime(date('Y-m-d'));
		$this->calendar->setEndDate($date);

		$this->assertEquals($date, $this->calendar->getEndDate());
		$this->assertContains("DTEND:" . $date->format('Ymd\THis\Z') . "\r\n", $this->calendar->getCalendar());
	}

	public function testOrganizer() 
	{
		$this->calendar->setOrganizer('mail@example.com');

		$this->assertEquals('mail@example.com', $this->calendar->getOrganizer());
		$this->assertContains("ORGANIZER:mailto:mail@example.com\r\n", $this->calendar->getCalendar());
	}

	public function testUid() 
	{
		// check for organizer domain, given it setUp()
		$this->assertContains('@example.com', $this->calendar->getUuid());
		$this->assertContains("@example.com\r\n", $this->calendar->getCalendar());
	}

	public function testAddAttendees() 
	{
		$this->calendar->setAttendees(['mail@example.com', 'example@mail.com']);

		$this->assertContains('mail@example.com', $this->calendar->getAttendees());
		$this->assertContains('example@mail.com', $this->calendar->getAttendees());
		$this->assertContains("ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN=mail@example.com;X-NUM-GUESTS=0:mailto:mail@example.com\r\n", $this->calendar->getCalendar());
		$this->assertContains("ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN=example@mail.com;X-NUM-GUESTS=0:mailto:example@mail.com\r\n", $this->calendar->getCalendar());
	}

	public function testAddSingleAttendee() 
	{
		$this->calendar->addAttendee('mail@example.com');

		$this->assertContains('mail@example.com', $this->calendar->getAttendees());
		$this->assertContains("ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN=mail@example.com;X-NUM-GUESTS=0:mailto:mail@example.com\r\n", $this->calendar->getCalendar());
	}

	public function testDescription() 
	{
		$this->calendar->setDescription('Lorem ipsum');

		$this->assertEquals('Lorem ipsum', $this->calendar->getDescription());
		$this->assertContains("DESCRIPTION:Lorem ipsum\r\n", $this->calendar->getCalendar());
	}

	public function testLocation() 
	{
		$this->calendar->setLocation('Olympos');

		$this->assertEquals('Olympos', $this->calendar->getLocation());
		$this->assertContains("LOCATION:Olympos\r\n", $this->calendar->getCalendar());
	}

	public function testSequence() 
	{
		$this->calendar->setSequence(1);

		$this->assertEquals(1, $this->calendar->getSequence());
		$this->assertContains("SEQUENCE:1\r\n", $this->calendar->getCalendar());
	}

	public function testSummary() 
	{
		$this->calendar->setSummary('Dolor sit amet');

		$this->assertEquals('Dolor sit amet', $this->calendar->getSummary());
		$this->assertContains("SUMMARY:Dolor sit amet\r\n", $this->calendar->getCalendar());
	}

	public function testTransp() 
	{
		$this->calendar->setTransp('TRANSPARENT');

		$this->assertEquals('TRANSPARENT', $this->calendar->getTransp());
		$this->assertContains("TRANSP:TRANSPARENT\r\n", $this->calendar->getCalendar());
	}

	public function testDefaultValues() 
	{
		$this->assertContains("BEGIN:VCALENDAR\r\n", $this->calendar->getCalendar());
		$this->assertContains("VERSION:2.0\r\n", $this->calendar->getCalendar());
		$this->assertContains("METHOD:REQUEST\r\n", $this->calendar->getCalendar());
		$this->assertContains("BEGIN:VEVENT\r\n", $this->calendar->getCalendar());
		$this->assertContains("UID", $this->calendar->getCalendar());
		$this->assertContains("CREATED", $this->calendar->getCalendar());
		$this->assertContains("LAST-MODIFIED", $this->calendar->getCalendar());
		$this->assertContains("SEQUENCE:0\r\n", $this->calendar->getCalendar());
		$this->assertContains("STATUS:CONFIRMED\r\n", $this->calendar->getCalendar());
		$this->assertContains("END:VEVENT\r\n", $this->calendar->getCalendar());
		$this->assertContains("END:VCALENDAR\r\n", $this->calendar->getCalendar());
	}

	public function testMissingFields() 
	{
		$this->expectException(Exception::class);

		$cal = new ICalendar();
		$cal->getCalendar();
	}
}