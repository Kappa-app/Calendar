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
use Nette\Utils\DateTime;

/**
 * Class CalendarControl
 * @package Kappa\Calendar
 */
class CalendarControl extends Control
{
	/** @var string @persistent */
	public $date;

	public function handleNext()
	{
		$date = new DateTime($this->date);
		$date->modify('+1 month');
		$this->date = $date->format('Y-m-d');
		if ($this->presenter->isAjax()) {
			$this->redrawControl('kappa-calendar');
		} else {
			$this->redirect('this');
		}
	}

	public function handlePrev()
	{
		$date = new DateTime($this->date);
		$date->modify('-1 month');
		$this->date = $date->format('Y-m-d');
		if ($this->presenter->isAjax()) {
			$this->redrawControl('kappa-calendar');
		} else {
			$this->redirect('this');
		}
	}

	/**
	 * @param string|null $file
	 */
	public function render($file = null)
	{
		$this->template->setFile(($file) ? : __DIR__ . '/templates/calendar.latte');
		$this->template->calendar = new Calendar(new DateTime($this->date));
		$this->template->render();
	}
}