<?php
/**
 * This file is part of the Kappa/Calendar package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 * 
 * @testCase
 */

namespace Kappa\Calendar\Tests;

use Kappa\Calendar\CalendarControl;
use Kappa\Calendar\CalendarFactory;
use Kappa\Tester\TestCase;
use Nette\Utils\DateTime;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * Class CalendarFactoryTest
 * @package calendar\Tests
 */
class CalendarFactoryTest extends TestCase
{
	/** @var \Kappa\Calendar\CalendarFactory */
	private $calendarFactory;

	protected function setUp()
	{
		$this->calendarFactory = new CalendarFactory();
	}

	public function testCreate()
	{
		$calendar = $this->calendarFactory->create(new DateTime('2015-03-01'));
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
	}
}

\run(new CalendarFactoryTest());