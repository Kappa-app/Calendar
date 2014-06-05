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
use Nette\Object;
use Nette\Utils\DateTime;

/**
 * Class CalendarFactory
 * @package Kappa\Calendar
 */
class CalendarFactory extends Object
{
	/**
	 * @param DateTime $date
	 * @return array
	 */
	public function create(DateTime $date)
	{
		$calendar = array();
		$itemNumber = 1;
		$firstDay = $this->getFirstDay($date);
		$endDay = $firstDay + $this->getCountOfDays($date);
		for ($line = 1; $line <= 6; $line++) {
			for ($column = 1; $column <= 7; $column++) {
				$calendar[$line][$column] = null;
				if ($itemNumber >= $firstDay && $itemNumber < $endDay) {
					$dayNumber = $itemNumber - $firstDay + 1;
					$dayDate = "{$date->format('Y')}-{$date->format('m')}-{$dayNumber}";
					$calendar[$line][$column] = new DateTime($dayDate);
				}
				$itemNumber++;
			}
		}

		return $calendar;
	}

	/**
	 * @param DateTime $date
	 * @return int
	 */
	private function getFirstDay(DateTime $date)
	{
		$date = $date->setDate($date->format('Y'), $date->format('m'), 1);

		return (int)$date->format('N');
	}

	/**
	 * @param DateTime $date
	 * @return int
	 */
	private function getCountOfDays(DateTime $date)
	{
		return (int)$date->format('t');
	}
}
