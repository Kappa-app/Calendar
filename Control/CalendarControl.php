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
	 * @var type array()
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
	 * @var type int
	 */
	private $actualMonth;
	
	/**
	 * @var type int
	 */
	private $actualYear;
	
	/**
	 * @var type array
	 */
	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->actualMonth = date('n');
		$this->actualYear = date('Y');
	}

	/**
	 * @param \Nette\Http\Session $session
	 */
	public function setSession(\Nette\Http\Session $session)
	{
		$this->_session = $session;
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
	 * @param $data
	 */
	public function setEvents($data)
	{
		$this->data = $data;
	}
	
	/**
	 * @return array()
	 */
	private function getEvents()
	{
		$events = array();
		foreach($this->data as $result)
		{
			$events[] = date('j.n.Y' , strtotime($result['date']));
		}
		return $events;
	}
	
	/**
	 * @return array
	 */
	private function createCalendar()
	{
		$calendar = array();
		$day = 1;
		for($y = 0; $y < 5; $y++)
		{
			for($i = 1; $i <= 7; $i++)
			{
				if($y * 7 + $i >= date('w', mktime(0, 0, 0, $this->actualMonth, 1, $this->actualYear)))
				{
					$calendar[$y][$i] = $day;
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
		$this->template->setFile(LIBS_DIR . '/Calendar/Templates/Calendar.latte');
		$this->template->monthNumber = $this->actualMonth;
		$this->template->actualMonth = $this->month[$this->actualMonth]; 
		$this->template->actualYear = $this->actualYear;
		$this->template->events = $this->getEvents();
		$this->template->calendar = $this->createCalendar();
		$this->template->render();	
	}
}