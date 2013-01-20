#Calendar
-

Easy system for work with events and can by used as core for booking system.
Calendar can detect actual day (add class="today"), busy days (add class="busy") and free days (add class="free").

###Settings:
1. Added Kappa:Calendar into your project
	"require":{
                "php": ">= 5.3.0",
         	"kappa/framewrok": "dev-master",
         	"kappa/calendar": "dev-master",
         	"nette/nette": "dev-master"
         }

2. Run [Composer](http://getcomposer.org)
	$ composer install
or
	$ composer update

3. Register Calendar factory into config file
	CalendarFactory: Kappa\Packages\Calendar\CalendarFactory
        CalendarHelper: Kappa\Packages\Calendar\CalendarHelper

4. Added CalendarHelper into automatic helpers loader
	helpers:
		getClass: @CalendarHelper::getClass

5. Create component Calendar
	/**
	 * @var Kappa\Packages\Calendar\CalendarFactory
	 */
	protected $calendarFactory;

	protected function createComponentCalendar()
	{
		$calendar = $this->calendarFactory;
		$calendar->setEvents($events); // unrequired
		$calendar->setTemplate($yourTemplate); // unrequired
		return $calendar->create();

	}

###Requirements:
-
* PHP 5.3.*
* [Kappa:Framework](https://github.com/Kappa-org/Framework)
* [Nette Framework](http://nette.org)





