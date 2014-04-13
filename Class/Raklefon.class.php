<?php 

spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});


/*
*	ORC SHIP
*/
class Raklefon extends Ship
{
	public				$width = 8;
	public				$height = 4;
	public				$endurance = 7;
	public 				$move = 15;
	public				$power = 14;
	public				$PV = 18;
	public				$name = "Raklefon";
	public				$price = 3500;
	public				$faction="Orcs";

	public function		__construct(){}
	
}

?>