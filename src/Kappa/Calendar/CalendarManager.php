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

use Nette\DateTime;
use Nette\Object;

/**
 * Class CalendarManager
 * @package Kappa\Calendar
 */
class CalendarManager extends Object
{
	/**
	 * @param array $day
	 * @return bool
	 */
	public function isActualDay(array $day)
	{
		$actualDate = new DateTime();
		$actualDate->setTime(0, 0, 0);
		if (isset($day['datetime']) && $day['datetime'] == $actualDate) {
			return true;
		} else {
			return false;
		}
	}
}