#Kappa/Calendar [![Build Status](https://travis-ci.org/Kappa-org/Calendar.png?branch=master)](https://travis-ci.org/Kappa-org/Calendar)

Component for generation calendar prepared for next work with it

##Requirements:

* PHP 5.3 or higher
* [Composer](http://getcomposer.org/)
* [Nette Framework](http://nette.org)
* [nette.ajax.js](https://github.com/vojtech-dobes/nette.ajax.js/)

##Installation
The best way to install Kappa/FileSystem is using Composer:
```bash
$ composer require kappa/filesystem:@dev
```

Register Kappa\Calendar\CalendarFactory class

```yaml
services:
	- Kappa\Calendar\CalendarFactory
```

and use nette.ajax.js
```javascript
$.nette.init()
```

###Usages
and next add component into presenter

```php
/**
 * @inject
 * @var \Kappa\Calendar\ICalendarFactory
 */
public $calendarFactory;

/**
 * @return \Kappa\Calendar\CalendarControl
 */
protected function createComponentCalendar()
{
	return $this->calendarFactory->create();
}
```

you can add custom template with
```php
/**
 * @return \Kappa\Calendar\CalendarControl
 */
protected function createComponentCalendar()
{
	$calendar = $this->calendarFactory;
	$calendar->setTemplate(/* path to template */);
	return $calendar->create();
}
```

and you can add manager for work with day with
```php
/**
 * @return \Kappa\Calendar\CalendarControl
 */
protected function createComponentCalendar()
{
	$calendar = $this->calendarFactory;
	$calendar->setManager(new MyCalendarManager);
	return $calendar->create();
}
```
and your manager you can use with ```$manager``` variable in template

## Examples:

**Presenter**
```php
/**
 * @inject
 * @var \Kappa\Calendar\ICalendarFactory
 */
public $calendarFactory;

/**
 * @inject
 * @var \Kappa\Calendar\CalendarManager
 */
public $calendarManager;

/**
 * @return \Kappa\Calendar\CalendarControl
 */
protected function createComponentCalendar()
{
	$calendar = $this->calendarFactory;
	$calendar->setTemplate(__DIR__ . '/../templates/components/calendar.latte');
	$calendar->setManager($this->calendarManager);
	return $calendar->create();
}
```

**Tempalte**
```html
<tr n:foreach="$calendar as $row">
	<td n:foreach="$row as $dayNumber => $day"{if $manager->isActualDay($day)} class="active"{/if}>
		{if count($day) !== 0}
			{$day['day']}
		{/if}
	</td>
</tr>
```

Variable $manager contain default manager with method for check actual day


