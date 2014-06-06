<?php
/**
 * This file is part of the calendar package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace Kappa\Calendar\DI;

use Nette\DI\CompilerExtension;

/**
 * Class CalendarExtension
 * @package Kappa\Calendar\DI
 */
class CalendarExtension extends CompilerExtension
{
	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('calendarControl'))
			->setClass('Kappa\Calendar\CalendarControl')
			->setImplement('Kappa\Calendar\ICalendarControlFactory');
	}
}