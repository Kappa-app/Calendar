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
	private $fileTemplate;

	/** @var object */
	private $manager;

	/**
	 * @param object|null $manager
	 */
	public function __construct($manager = null)
	{
		parent::__construct();
		$this->date = new DateTime();
		$this->manager = $manager;
	}

	/**
	 * @param string|null $template
	 * @throws TemplateNotFoundException
	 */
	public function setTemplate($template = null)
	{
		if ($template !== null) {
			if (!is_file($template)) {
				throw new TemplateNotFoundException("Template {$template} has not been found");
			}
			$this->fileTemplate = $template;
		} else {
			$this->fileTemplate = __DIR__ . '/Templates/default.latte';
		}
	}

	/**
	 * @param string $date
	 */
	public function handlePrevMonth($date)
	{
		$date = new DateTime($date);
		$this->date = $date->modify('-1 month');
		if ($this->presenter->isAjax()) {
			$this->invalidateControl('calendar');
		} else {
			$this->redirect('this');
		}
	}

	/**
	 * @param string $date
	 */
	public function handleNextMonth($date)
	{
		$date = new DateTime($date);
		$this->date = $date->modify('+1 month');
		if ($this->presenter->isAjax()) {
			$this->invalidateControl('calendar');
		} else {
			$this->redirect('this');
		}
	}

	/**
	 * @return array
	 */
	private function createCalendar()
	{
		$calendar = array();
		$day = 1;
		$date = $this->date;
		for ($i = 0; $i <= 5; $i++) {
			for ($y = 1; $y <= 7; $y++) {
				$firstDay = $date->setDate($this->date->format('Y'), $this->date->format('m'), 1)
					->format('N');
				if ($i * 7 + $y >= $firstDay) {
					if ($day <= $this->date->format('t')) {
						$dayDate = "{$this->date->format('Y')}-{$this->date->format('m')}-{$day}";
						$calendar[$i][$y] = array(
							'day' => $day,
							'date' => new DateTime($dayDate),
						);
						$day++;
					} else {
						$calendar[$i][$y] = array();
					}
				} else {
					$calendar[$i][$y] = array();
				}
			}
		}

		return $calendar;
	}

	public function render()
	{
		$this->template->setFile($this->fileTemplate);
		$this->template->date = $this->date;
		$this->template->calendar = $this->createCalendar();
		$this->template->manager = $this->manager;
		$this->template->render();
	}
}