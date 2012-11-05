<?php
/**
 * CalendarFactory.php
 * Autgor: Ondřej Záruba <zarubaondra@gmail.com>
 * Date: 2.11.12
 */

namespace Kappa\Packages\Calendar;

class CalendarFactory extends \Kappa\Application\UI\ControlFactory
{
	/**
	 * @var type array
	 */
	private $data;

	/**
	 * @param array $data
	 */
	public function setEvents($data)
	{
		$this->data = $data;
	}

	/**
	 * @return CalendarControl
	 */
	public function create()
	{
		$calendar = new \Kappa\Packages\Calendar\CalendarControl;
		$calendar->setEvents($this->data);
		return $calendar;
	}
}
