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

	/**
	 * @param null $template
	 */
	public function setTemplate($template = null)
	{
		$this->template = (string)$template;
	}

	/**
	 * @return CalendarControl
	 */
	public function create()
	{
		$calendar = new CalendarControl;
		$calendar->setTemplate($this->template);

		return $calendar;
	}
}
