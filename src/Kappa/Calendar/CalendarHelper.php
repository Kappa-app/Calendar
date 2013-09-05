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

use Nette;

/**
 * Class CalendarHelper
 * @package Kappa\Calendar
 */
class CalendarHelper extends Nette\Object
{
	/**
	 * @param array $day
	 * @return string
	 */
	public function getClass($day)
	{
		if(count($day) == 0)
			return;
		unset($day['day']);

		if($day['date'] == date('j.n.Y', strtotime('now')))
			return "today";
		if($day['blocked'])
			return "blocked";

		unset($day['date']);
		unset($day['blocked']);
		$countTime = count($day);
		$freeTime = 0;
		$blockedTime = 0;
		if($countTime > 0)
		{
			foreach($day as $time => $value)
			{
				if($value)
					$blockedTime++;
				else
					$freeTime++;
			}
			if($countTime == $blockedTime)
				return "busy";
			if($freeTime > 0 && $blockedTime > 0)
				return "partly";
		}
	}
}
