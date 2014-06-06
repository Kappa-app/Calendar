<?php
/**
 * This file is part of the calendar package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace Kappa\Calendar;

/**
 * Interface ICalendarControlFactory
 * @package Kappa\Calendar
 */
interface ICalendarControlFactory
{
	/**
	 * @return CalendarControl
	 */
	public function create();
} 