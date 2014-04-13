<?php 

spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});


/*
*	DALEKS SHIP
*/
class Realitybomb extends Ship
{
	public				$width = 12;
	public				$height = 7;
	public				$endurance = 12;
	public 				$move = 7;
	public				$power = 17;
	public				$PV = 10;
	public				$name = "RealityBomb";
	public				$price = 2500;
	public				$faction="Daleks";
	
	public function		__construct(){}
}

?>