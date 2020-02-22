<?php 
namespace Ostro\PupilsInfos;
use Ostro\DataBaseConnect\Connected;
use Ostro\PupilsInfos\PupilsOf_3;
use Ostro\PupilsInfos\PupilsOf_6;
use Ostro\SqlRequests\Requestor;
use Ostro\Routing\Router;
use \PDO;




class BonusManager{

	/**
	 * the id of the pupil
	 * @var int
	 */
	private $id;

	/**
	 * the type of the bonus +1 or -1
	 * @var string
	 */
	private $bonusType;

	/**
	 * The level of the pupil. In this case 3eme or 6eme
	 * @var string
	 */
	private $level;

	/**
	 * The object 
	 * @var object of Pupils
	 */
	private $status;

	/**
	 * Use the current class
	 * @var class
	 */
	private $classMaping;


	/**
	 * [__construct description]
	 * @param int    $level     [description]
	 * @param int    $id        [description]
	 * @param string $bonusType [description]
	 */
	public function __construct(int $level, int $id, string $bonusType)
	{
		$this->level = $level;
		$this->id = $id;
		$this->bonusType = $bonusType;
		

		if ($level == 6) {
			$this->status = new PupilsOf_6();
			$this->status->setID($this->id);
			$this->classMaping = PupilsOf_6::class;
		}
		elseif ($level == 3) {
			$this->status= new PupilsOf_3();
			$this->status->setID($this->id);
			$this->classMaping = PupilsOf_3::class;
		}
	}



    /**
	 * Use to update the bonus
	 * @return string the code to set in the header if it's +1(if code === "Bonus") or -1(if code === "bonus") be carefull for the case in the code syntax
	 * @return Bonus|bonus|null
	 * @param  string $inTable the target Table in the database
	*/
	public function doBonusAndRedirect(string $inTable):?string
	{
		$id = $this->id;
		$code = null;
		$r = new Requestor($this->classMaping);
		$pupil = $r->getBonuser($inTable, ($this->status)->getTable(), $id);
		$defaultBonus = (float)$pupil->getBonus();
		$type = $this->bonusType;

		if (isset($type) && $type === "p") {
			$bonus = $defaultBonus + 1;
		}
		elseif (isset($type) && $type === "m") {
			$bonus = $defaultBonus - 1;
		}

		$r->updaterBonuser($inTable, $bonus, $id);

		if ($r && $type === "p") {
			$code = "Bonus";
		}
		elseif ($r && $type === "m") {
			$code = "bonus";
		}
		return $code;
	}
}