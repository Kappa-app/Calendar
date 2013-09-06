<?php
/**
 * This file is part of the Kappa/Calendar package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace Kappa\Calendar;

use Kappa;

/**
 * Class CalendarFactory
 * @package Kappa\Calendar
 */
class CalendarFactory implements ICalendarFactory
{
	/** @var string */
	private $template;

	/** @var mixed */
	private $manager;

	/**
	 * @param string $template
	 */
	public function setTemplate($template)
	{
		$this->template = $template;
	}

	/**
	 * @param mixed $manager
	 */
	public function setManager($manager)
	{
		$this->manager = $manager;
	}

	/**
	 * @return CalendarControl
	 */
	public function create()
	{
		$calendar = new CalendarControl($this->manager);
		$calendar->setTemplate($this->template);

		return $calendar;
	}
}
