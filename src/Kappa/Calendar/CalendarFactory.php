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

/**
 * Class CalendarFactory
 * @package Kappa\Calendar
 */
class CalendarFactory implements ICalendarFactory
{
	/** @var string */
	private $template;

	/** @var array */
	private $events = array();

	/** @var array */
	private $blockDays = array();

	/**
	 * @param null $template
	 */
	public function setTemplate($template = null)
	{
		$this->template = (string)$template;
	}

	/**
	 * @param array $events
	 */
	public function setEvents(array $events = array())
	{
		$this->events = $events;
	}

	/**
	 * @param array $blockDays
	 */
	public function setBlockDays(array $blockDays = array())
	{
		$this->blockDays = $blockDays;
	}

	/**
	 * @return CalendarControl
	 */
	public function create()
	{
		$calendar = new CalendarControl;
		$calendar->setTemplate($this->template);
		$calendar->setEvents($this->events);
		$calendar->setBlockDays($this->blockDays);
		return $calendar;
	}
}
