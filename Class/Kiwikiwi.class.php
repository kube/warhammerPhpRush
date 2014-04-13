<?php 

spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});


/*
*	TROLL SHIP
*/
class Kiwikiwi extends Ship
{
	public				$width = 5;
	public				$height = 2;
	public				$endurance = 6;
	public 				$move = 17;
	public				$power = 8;
	public				$PV = 17;
	public				$name = "KiwiKiwi";
	public				$price = 1500;
	public				$faction="Trolls";

	public function		__construct(){}
	
}

?>