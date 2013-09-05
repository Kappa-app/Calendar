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

use Nette\Application\UI\Control;
use Nette\DateTime;

/**
 * Class CalendarControl
 * @package Kappa\Calendar
 */
class CalendarControl extends Control
{
	/** @var \Nette\DateTime */
	private $date;

	/** @var string */
	private $_template;
	
	/** @var array */
	private $events;

	/** @var array */
	private $blockDays;

	public function __construct()
	{
		parent::__construct();
		$this->date = new DateTime();
	}

	/**
	 * @param null $template
	 * @throws \Kappa\FileNotFoundException
	 */
	public function setTemplate($template = null)
	{
		if($template)
		{
			if(!file_exists($template))
				throw new \Kappa\FileNotFoundException(__METHOD__, $template);
			$this->_template = (string)$template;
		}
		else
			$this->_template = __DIR__ . '/Templates/default.latte';
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
	 * @param string $date
	 */
	public function handlePrevMonth($date)
	{
		$date = new DateTime($date);
		$this->date = $date->modify('-1 month');
		if($this->presenter->isAjax())
			$this->invalidateControl('calendar');
		else
			$this->redirect('this');
	}

	/**
	 * @param string $date
	 */
	public function handleNextMonth($date)
	{
		$date = new DateTime($date);
		$this->date = $date->modify('+1 month');
		if($this->presenter->isAjax())
			$this->invalidateControl('calendar');
		else
			$this->redirect('this');
	}
	
	/**
	 * @return array
	 */
	private function createCalendar()
	{
		$calendar = array();
		$day = 1;
		$mktimeMonth = $this->date->getTimestamp();
		for($y = 0; $y < 5; $y++)
		{
			for($i = 1; $i <= 7; $i++)
			{
				if($y * 7 + $i >= date('w', $mktimeMonth))
				{
					if($day <= date('t', $mktimeMonth))
					{
						$date = $this->date;
						$mktimeDay = $date->setDate($date->format('Y'), $date->format('m'), $date->format('d'));
						$contain['day'] = $day;
						$today = $mktimeDay->format('j.n.Y');
						$contain['date'] = $today;
						if(in_array($today, $this->blockDays) || in_array($this->date->format('D'), $this->blockDays))
							$contain['blocked'] = true;
						else
							$contain['blocked'] = false;
						if(array_key_exists($today, $this->events))
						{

							foreach($this->events[$today] as $time => $bool)
							{
								$contain[$time] = $bool;
							}

						}
						$calendar[$y][$i] = $contain;
						$contain = array();
					}
					else
						$calendar[$y][$i] = array();
					$day++;
				}
				else
					$calendar[$y][$i] = array();
			}
		}
		return $calendar;
	}
	
	public function render()
	{
		$this->template->setFile($this->_template);
		$this->template->date = $this->date;
		$this->template->calendar = $this->createCalendar();
		$this->template->render();	
	}
}