<?php
/**
 * CalendarControl.php
 * Autgor: Ondřej Záruba <zarubaondra@gmail.com>
 * Date: 2.11.12
 */

namespace Kappa\Packages\Calendar;

class CalendarControl extends \Nette\Application\UI\Control
{
	/**
	 * @var array
	 */
	private $month = array(
	    1 => 'Leden',
	    2 => 'Únor',
	    3 => 'Březen',
	    4 => 'Duben',
	    5 => 'Květen',
	    6 => 'Červen',
	    7 => 'Červenec',
	    8 => 'Srpen',
	    9 => 'Září',
	    10 => 'Říjen',
	    11 => 'Listopad',
	    12 => 'Prosinec',
	);
	
	/**
	 * @var int
	 */
	private $actualMonth;
	
	/**
	 * @var int
	 */
	private $actualYear;

	private $_template;
	
	/**
	 * @var array
	 */
	private $events;

	public function __construct()
	{
		parent::__construct();
		$this->actualMonth = date('n');
		$this->actualYear = date('Y');
	}

	/**
	 * @param null|string $template
	 * @throws InvalidArgumentException
	 */
	public function setTemplate($template = null)
	{
		if($template)
		{
			if(!file_exists($template))
				throw new InvalidArgumentException('Class ' . __METHOD__ . ' required real path to template. Template "'.$template.'" not found');
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
	 * @param int $month
	 * @param int $year
	 */
	public function handlePrevMonth($month, $year)
	{
		if($month - 1 == 0)
		{
			$this->actualMonth = 12;
			$this->actualYear = $year - 1;
		}
		else
		{
			$this->actualMonth = $month - 1;
			$this->actualYear = $year;
		}
		if($this->presenter->isAjax())
			$this->invalidateControl('calendar');
		else
			$this->redirect('this');
	}
	
	/**
	 * @param int $month
	 * @param int $year
	 */
	public function handleNextMonth($month, $year)
	{
		if($month  == 12)
		{
			$this->actualMonth = 1;
			$this->actualYear = $year + 1;
		}
		else
		{
			$this->actualMonth = $month + 1;
			$this->actualYear = $year;
		}
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
		$mktimeMonth = mktime(0, 0, 0, $this->actualMonth, 1, $this->actualYear);
		for($y = 0; $y < 5; $y++)
		{
			for($i = 1; $i <= 7; $i++)
			{
				if($y * 7 + $i >= date('w', $mktimeMonth))
				{
					if($day <= date('t', $mktimeMonth))
					{
						$mktimeDay = mktime(0, 0, 0, $this->actualMonth, $day, $this->actualYear);
						$hours['day'] = $day;
						$today = date('j.n.Y', $mktimeDay);
						if(array_key_exists($today, $this->events))
							foreach($this->events[$today] as $time => $bool)
							{
								$hours[$time] = $bool;
							}

						$calendar[$y][$i] = $hours;
					}
					else
						$calendar[$y][$i] = 0;
					$day++;
				}
				else
					$calendar[$y][$i] = 0;
			}
		}
		return $calendar;
	}
	
	public function render()
	{
		$this->template->setFile($this->_template);
		$this->template->monthNumber = $this->actualMonth;
		$this->template->actualMonth = $this->month[$this->actualMonth]; 
		$this->template->actualYear = $this->actualYear;
		$this->template->calendar = $this->createCalendar();
		$this->template->render();	
	}
}