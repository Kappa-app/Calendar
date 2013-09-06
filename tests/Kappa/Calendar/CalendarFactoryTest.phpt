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

	public function testSetTemplate()
	{
		Assert::same(null, $this->getReflection()->invokeProperty($this->calendarFactory, 'template'));
		$this->calendarFactory->setTemplate(__FILE__);
		Assert::same(__FILE__, $this->getReflection()->invokeProperty($this->calendarFactory, 'template'));
	}

	public function testSetManager()
	{
		Assert::same(null, $this->getReflection()->invokeProperty($this->calendarFactory, 'manager'));
		$this->calendarFactory->setManager($this);
		Assert::same($this, $this->getReflection()->invokeProperty($this->calendarFactory, 'manager'));
	}

	public function testCreate()
	{
		Assert::equal(new CalendarControl(), $this->calendarFactory->create());
	}
}

\run(new CalendarFactoryTest());