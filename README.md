#Calendar
-

Easy system for work with events and can by used as core for booking system.
Calendar can detect actual day (add class="today"), busy days (add class="busy") and free days (add class="free").

###Settings:
1. Added Kappa:Calendar into your project
<pre>
	"require":{
		"php": ">= 5.3.0",
		"kappa/framewrok": "dev-master",
		"kappa/calendar": "dev-master",
		"nette/nette": "dev-master"
         }
</pre>
2. Run [Composer](http://getcomposer.org)
<pre>
	$ composer install
</pre>
or
<pre>
	$ composer update
</pre>
3. Register Calendar factory into config file
<pre>
	CalendarFactory: Kappa\Packages\Calendar\CalendarFactory
	CalendarHelper: Kappa\Packages\Calendar\CalendarHelper
</pre>
4. Added CalendarHelper into automatic helpers loader
<pre>
	helpers:
		getClass: @CalendarHelper::getClass
</pre>
5. Create component Calendar
<pre>
	protected $calendarFactory;

	public function injectCalendarFactory(Kappa\Packages\Calendar\CalendarFactory $calendarFactory)
	{
		$this->calendarFactory = $calendarFactory;
	}

	protected function createComponentCalendar()
	{
		$calendar = $this->calendarFactory;
		$calendar->setEvents($events); // unrequired
		$calendar->setTemplate($yourTemplate); // unrequired
		return $calendar->create();

	}
</pre>

###Configuration
When you create component you can use three method for add setting for calendar
<pre>
	$caledarFactory->setEvets(/* array */);
	$caledarFactory->setBlockDays(/* array */);
	$caledarFactory->setTemplate(/* string - path to file */);
</pre>

####setEvents()
<pre>
	$events = array(
		'12.1.2013' => array(
			'1:00' => true,
			'2:00' => false
			),
		);
	$calendarFactory->setEvents($events);

</pre>

####setBlockDays()
Allowable entries:

1. A textual representation of a day, three letters (example "Mon") // Every Monday will be blocked

2. Date (example "1.1.2013") // Date 1.1.2013 will be blocked

<pre>
	$blockDays = array('Mon', '1.1.2013'); // Every Monday and 1.1.2013
	$calendarFactory->setBlockDays($blockDays);
</pre>

####setTemplate()
<pre>
	$template = __DIR__ . '/../templates/components/calendar.latte';
	$calendarFactory->setTemplate($template);
 </pre>

###Requirements:
-
* PHP 5.3.*
* [Kappa:Framework](https://github.com/Kappa-org/Framework)
* [Nette Framework](http://nette.org)





