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
	private $events;

	/**
	 * @param null $template
	 * @throws \Kappa\Exceptions\LogicException\InvalidArgumentException
	 */
	public function setTemplate($template = null)
	{
		if($template)
		{
			if(!file_exists($template))
				throw new InvalidArgumentException('Class ' . __METHOD__ . ' required real path to template. Template "'.$template.'" not found');
			$this->template = (string)$template;
		}
		else
			$this->template = __DIR__ . '/Templates/default.latte';
	}

	/**
	 * @param array $events
	 */
	public function setEvents(array $events = array())
	{
		$this->events = $events;
	}

	/**
	 * @return CalendarControl
	 */
	public function create()
	{
		$calendar = new CalendarControl;
		$calendar->setTemplate($this->template);
		$calendar->setEvents($this->events);
		return $calendar;
	}
}
