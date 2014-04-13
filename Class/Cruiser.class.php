<?php 

spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});


/*
*	ORC SHIP
*/
class Cruiser extends Ship
{
	public				$width = 4;
	public				$height = 1;
	public				$endurance = 4;
	public 				$move = 18;
	public				$power = 8;
	public				$PV = 4;
	public				$name = "WraithCruiser";
	public				$price = 1000;
	public				$faction="Orcs";

	public function		__construct(){}
	
}

?>