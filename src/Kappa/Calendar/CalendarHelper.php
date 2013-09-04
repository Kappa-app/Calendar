<?php
/**
 * CalendarHelper.php
 *
 * @author Ondřej Záruba <zarubaondra@gmail.com>
 * @date 20.1.13
 *
 * @package Kappa
 */

namespace Kappa\Calendar;

use Nette;

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
