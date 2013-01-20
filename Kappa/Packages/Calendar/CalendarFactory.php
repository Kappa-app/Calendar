<?php
/**
 * CalendarFactory.php
 * Autgor: Ondřej Záruba <zarubaondra@gmail.com>
 * Date: 2.11.12
 */

namespace Kappa\Packages\Calendar;

use Kappa\Exceptions\LogicException\InvalidArgumentException;

class CalendarFactory extends \Kappa\Application\UI\ControlFactory implements ICalendarFactory
{
	/**
	 * @var string
	 */
	private $template;

	/**
	 * @var array
	 */
	private $events = array();

	/**
	 * @var array
	 */
	private $blockDays = array();

	/**
	 * @param null $template
	 * @throws \Kappa\Exceptions\LogicException\InvalidArgumentException
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
