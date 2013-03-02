<?php
/**
 * ICalendarFactory.php
 *
 * @author Ondřej Záruba <zarubaondra@gmail.com>
 * @date 20.1.13
 *
 * @package Kappa
 */

namespace Kappa\Packages\Calendar;

interface ICalendarFactory
{
	/**
	 * @return CalendarControl
	 */
	public function create();
}
