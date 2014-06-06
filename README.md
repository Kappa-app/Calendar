# Kappa\Calendar [![Build Status](https://travis-ci.org/Kappa-org/Calendar.png?branch=master)](https://travis-ci.org/Kappa-org/Calendar)

Component for generation calendar prepared for next work with it

## Requirements:

* PHP 5.3 or higher
* [Composer](http://getcomposer.org/)
* [nette/application](https://github.com/nette/application) 2.2 or higher
* [nette/di](https://github.com/nette/di) 2.2 or higher

## Installation
The best way to install kappa/calendar is using Composer:
```bash
$ composer require kappa/calendar:@dev
```
And now you have to register the extensions in ```config.neon```

```yaml
extensions:
	- Kappa\Calendar\CalendarExtension
```

## Usages

You can use default component with default or custom template

```php
/**
 * @inject
 * @var \Kappa\Calendar\ICalendarControlFactory
 */
public $calendarControlFactory;

/**
 * @return \Kappa\Calendar\CalendarControl
 */
protected function createComponentCalendar()
{
	return $this->calendarControlFactory->create();
}
```

with custom template

```php
/**
 * @return \Kappa\Calendar\CalendarControl
 */
protected function createComponentCalendar()
{
	$calendar = $this->calendarControlFactory->create();
	$calendar->setTemplate('template.latte');

	return $calendar;
}
```

or in template

```html
{control calendar 'template.latte'}
```

In template will be ```$calendar``` variable contains Calendar object for more info please see into
[default template](https://github.com/Kappa-app/Calendar/blob/master/src/Kappa/Calendar/templates/calendar.latte)