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

use Kappa\Tester\TestCase;
use Nette\DI\Container;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * Class CalendarExtensionTest
 * @package calendar\Tests
 */
class CalendarExtensionTest extends TestCase
{
	/** @var \Nette\DI\Container */
	private $container;

	/**
	 * @param Container $container
	 */
	public function __construct(Container $container)
	{
		$this->container = $container;
	}

	public function testDI()
	{
		$type = 'Kappa\Calendar\ICalendarControlFactory';
		$service = $this->container->getByType($type);
		Assert::type($type, $service);
	}
}

\run(new CalendarExtensionTest(getContainer()));