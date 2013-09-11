<?php
/**
 * This file is part of the Kappa\Calendar package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 * 
 * @testCase
 */

namespace Kappa\Calendar\Tests;

use Kappa\Calendar\CalendarHelper;
use Kappa\Tester\TestCase;
use Nette\DateTime;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * Class CalendarManagerTest
 * @package Kappa\Calendar\Tests
 */
class CalendarManagerTest extends TestCase
{
	/** @var \Kappa\Calendar\CalendarHelper */
	private $calendarManager;

	protected function setUp()
	{
		$this->calendarManager = new CalendarHelper();
	}

	public function testIsActualDay()
	{
		Assert::false($this->calendarManager->isActualDay(array('day' => 5, 'datetime' => new DateTime('5.3.2013'))));
		$date = new DateTime();
		$date->setTime(0, 0, 0);
		Assert::true($this->calendarManager->isActualDay(array('day' => date('d'), 'datetime' => $date)));
	}
}

\run(new CalendarManagerTest());