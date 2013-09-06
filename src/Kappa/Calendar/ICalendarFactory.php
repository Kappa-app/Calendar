<?php
/**
 * This file is part of the Kappa/Console package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace Kappa\Calendar;

/**
 * Class ICalendarFactory
 * @package Kappa\Calendar
 */
interface ICalendarFactory
{
	/**
	 * @return CalendarControl
	 */
	public function create();

	/**
	 * @param string|null $template
	 * @return void
	 */
	public function setTemplate($template);

	/**
	 * @param mixed|null $manager
	 * @return void
	 */
	public function setManager($manager);
}
