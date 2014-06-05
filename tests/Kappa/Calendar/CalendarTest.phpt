<?php
/**
 * This file is part of the calendar package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 * 
 * @testCase
 */

namespace calendar\Tests;

use Kappa\Calendar\Calendar;
use Kappa\Tester\TestCase;
use Nette\Utils\DateTime;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * Class CalendarTest
 * @package calendar\Tests
 */
class CalendarTest extends TestCase
{
	public function testInstance()
	{
		$date = new DateTime('2015-03-01');
		$calendar = new Calendar($date);
		Assert::equal($date, $calendar->getDate());
		$calendar = new Calendar();
		Assert::equal(new DateTime(), $calendar->getDate());
	}

	public function testGetCalendar()
	{
		$calendarEntity = new Calendar(new DateTime('2015-03-01'));
		$calendar = $calendarEntity->getCalendar();
		Assert::null($calendar[1][1]);
		Assert::null($calendar[1][2]);
		Assert::null($calendar[1][3]);
		Assert::null($calendar[1][4]);
		Assert::null($calendar[1][5]);
		Assert::null($calendar[1][6]);
		Assert::equal(new DateTime('2015-03-01'), $calendar[1][7]);
		Assert::equal(new DateTime('2015-03-31'), $calendar[6][2]);
		Assert::null($calendar[6][3]);
		Assert::null($calendar[6][4]);
		Assert::null($calendar[6][5]);
		Assert::null($calendar[6][6]);
		Assert::equal(new DateTime('2015-03-01'), $calendarEntity->getDate());
	}

	public function testDate()
	{
		$calendar = new Calendar(new DateTime('2015-03-01'));
		Assert::type(get_class($calendar), $calendar->setDate(2016,03,01));
		Assert::equal(new DateTime('2016-03-01'), $calendar->getDate());
	}

	public function testChangeYear()
	{
		$calendar = new Calendar(new DateTime('2015-03-01'));
		Assert::type(get_class($calendar), $calendar->nextYear());
		Assert::equal(new DateTime('2016-03-01'), $calendar->getDate());
		Assert::type(get_class($calendar), $calendar->prevYear());
		Assert::equal(new DateTime('2015-03-01'), $calendar->getDate());
	}

	public function testChangeMonth()
	{
		$calendar = new Calendar(new DateTime('2015-03-01'));
		Assert::type(get_class($calendar), $calendar->nextMonth());
		Assert::equal(new DateTime('2015-04-01'), $calendar->getDate());
		Assert::type(get_class($calendar), $calendar->prevMonth());
		Assert::equal(new DateTime('2015-03-01'), $calendar->getDate());
	}
}

\run(new CalendarTest());