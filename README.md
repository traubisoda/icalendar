# iCalendar
Simple [iCalendar event](https://tools.ietf.org/html/rfc5545) (*.ics) generator for PHP.

## Usage
```php
<?php

require_once 'vendor/autoload.php';

use ICalendar\ICalendar;
    ...
    ...
    ...

    try {
        // New calendar instance and setting values
        $calendar = (new ICalendar())
            ->setOrganizer('foo@bar.com')
            ->setStartDate(new DateTime(...))
            ->setEndDate(new DateTime(...))
            ->addAttendee('lorem@ipsum.com');
            
        // Get iCalendar 
        echo $calendar->getCalendar(); 
    }
    catch(\Exception $e) {
    
    }
```

## Available methods
Check code, it's no magic.

## Test
```
vendor/bin/phpunit tests
```