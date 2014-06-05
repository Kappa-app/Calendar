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

use Nette\Object;
use Nette\Utils\DateTime;

/**
 * Class Calendar
 * @package Kappa\Calendar
 */
class Calendar extends Object
{
	/** @var \Nette\Utils\DateTime */
	private $actualDate;

	/**
	 * @param DateTime $date
	 */
	public function __construct(DateTime $date = null)
	{
		$this->actualDate = ($date) ? : new DateTime();
	}

	/**
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 * @return $this
	 */
	public function setDate($year, $month, $day)
	{
		$this->actualDate->setDate($year, $month, $day);

		return $this;
	}

	/**
	 * @param int $year
	 * @return $this
	 */
	public function setYear($year)
	{
		$this->setDate($year, $this->actualDate->format('m'), $this->actualDate->format('d'));

		return $this;
	}

	/**
	 * @param int $month
	 * @return $this
	 */
	public function setMonth($month)
	{
		$this->setDate($this->actualDate->format('Y'), $month, $this->actualDate->format('d'));

		return $this;
	}

	/**
	 * @return $this
	 */
	public function nextYear()
	{
		$this->setYear((int)$this->actualDate->format('Y') + 1);

		return $this;
	}

	/**
	 * @return $this
	 */
	public function prevYear()
	{
		$this->setYear((int)$this->actualDate->format('Y') - 1);

		return $this;
	}

	/**
	 * @return $this
	 */
	public function nextMonth()
	{
		$this->setMonth((int)$this->actualDate->format('m') + 1);

		return $this;
	}

	/**
	 * @return $this
	 */
	public function prevMonth()
	{
		$this->setMonth((int)$this->actualDate->format('m') - 1);

		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getDate()
	{
		return $this->actualDate;
	}

	/**
	 * @return array
	 */
	public function getCalendar()
	{
		$calendar = array();
		$itemNumber = 1;
		$firstDay = $this->getFirstDay();
		$endDay = $firstDay + $this->getCountOfDays();
		for ($line = 1; $line <= 6; $line++) {
			for ($column = 1; $column <= 7; $column++) {
				$calendar[$line][$column] = null;
				if ($itemNumber >= $firstDay && $itemNumber < $endDay) {
					$dayNumber = $itemNumber - $firstDay + 1;
					$dayDate = "{$this->getDate()->format('Y')}-{$this->getDate()->format('m')}-{$dayNumber}";
					$calendar[$line][$column] = new DateTime($dayDate);
				}
				$itemNumber++;
			}
		}

		return $calendar;
	}

	/**
	 * @return int
	 */
	private function getFirstDay()
	{
		$date = clone $this->getDate();
		$date = $date->setDate($date->format('Y'), $date->format('m'), 1);

		return (int)$date->format('N');
	}

	/**
	 * @return int
	 */
	private function getCountOfDays()
	{
		$date = clone $this->getDate();
		return (int)$date->format('t');
	}
} 