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

###The data structure for the method setEvents()
<pre>
	array(
		'12.1.2013' => array(
			'1:00' => true,
			'2:00' => false
		),
	);
</pre>

###Requirements:
-
* PHP 5.3.*
* [Kappa:Framework](https://github.com/Kappa-org/Framework)
* [Nette Framework](http://nette.org)





