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

use Kappa\Calendar\CalendarControl;
use Kappa\Tester\TestCase;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * Class CalendarControlTest
 * @package Kappa\Calendar\Tests
 */
class CalendarControlTest extends TestCase
{
	/** @var \Kappa\Calendar\CalendarControl */
	private $calendarControl;

	protected function setUp()
	{
		$this->calendarControl = new CalendarControl();
	}

	public function testSetTemplate()
	{
		Assert::same(null, $this->getReflection()->invokeProperty($this->calendarControl, 'fileTemplate'));
		$this->calendarControl->setTemplate(__FILE__);
		Assert::same(__FILE__, $this->getReflection()->invokeProperty($this->calendarControl, 'fileTemplate'));
	}

	public function testSetManager()
	{
		Assert::same(null, $this->getReflection()->invokeProperty($this->calendarControl, 'manager'));
		$calendar = new CalendarControl($this);
		Assert::same($this, $this->getReflection()->invokeProperty($calendar, 'manager'));
	}
}

\run(new CalendarControlTest());