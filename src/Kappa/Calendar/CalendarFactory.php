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

	/** @var mixed */
	private $helper;

	/**
	 * @param null|string $template
	 * @throws TemplateNotFoundException
	 */
	public function setTemplate($template)
	{
			if (!is_file($template)) {
				throw new TemplateNotFoundException("Template {$template} has not been found");
			}
			$this->template = $template;
	}

	/**
	 * @param mixed $helper
	 */
	public function setHelper($helper)
	{
		$this->helper = $helper;
	}

	/**
	 * @return CalendarControl
	 */
	public function create()
	{
		$calendar = new CalendarControl($this->helper);
		$calendar->setTemplate($this->template);

		return $calendar;
	}
}
