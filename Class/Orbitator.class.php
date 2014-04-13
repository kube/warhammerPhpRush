<?php 

spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});


/*
*	DALEKS SHIP
*/
class Orbitator extends Ship
{
	public				$width = 10;
	public				$height = 2;
	public				$endurance = 4;
	public 				$move = 17;
	public				$power = 15;
	public				$PV = 10;
	public				$name = "Orbitator";
	public				$price = 2500;
	public				$faction="Daleks";
	
	public function		__construct(){}
}

?>