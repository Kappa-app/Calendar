<?php
/**
 * CalendarHelper.php
 * Autgor: Ondřej Záruba <zarubaondra@gmail.com>
 * Date: 20.1.13
 */

namespace Kappa\Packages\Calendar;

use Nette,
	Kappa\Exceptions\LogicException\InvalidArgumentException;

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
			if($countTime == $freeTime )
				return "free";
			if($countTime == $blockedTime)
				return "busy";
			if($freeTime > 0 && $blockedTime > 0)
				return "partly";
		}

	}
}
