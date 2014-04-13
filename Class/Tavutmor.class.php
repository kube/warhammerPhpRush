<?php 

spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});


/*
*	TROLL SHIP
*/
class Tavutmor extends Ship
{
	public				$width = 6;
	public				$height = 6;
	public				$endurance = 11;
	public 				$move = 16;
	public				$power = 15;
	public				$PV = 16;
	public				$name = "TavuTMor";
	public				$price = 3500;
	public				$faction="Trolls";

	public function		__construct(){}
	
}

?>