<?php
/**
 * ICalendarFactory.php
 * Autgor: Ondřej Záruba <zarubaondra@gmail.com>
 * Date: 20.1.13
 */

namespace Kappa\Packages\Calendar;

interface ICalendarFactory
{
	/**
	 * @return CalendarControl
	 */
	public function create();
}
