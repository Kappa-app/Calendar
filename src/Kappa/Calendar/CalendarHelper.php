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
class CalendarHelper extends Object
{
	/**
	 * @param DateTime $day
	 * @return bool
	 */
	public function isActualDay(DateTime $day = null)
	{
		$actualDate = new DateTime();
		$actualDate->setTime(0, 0, 0);
		if ($day == $actualDate) {
			return true;
		} else {
			return false;
		}
	}
}