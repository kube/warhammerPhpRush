<?php 

spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});


/*
*	ORC SHIP
*/
class Kranhcrash extends Ship
{
	public				$width = 5;
	public				$height = 3;
	public				$endurance = 6;
	public 				$move = 20;
	public				$power = 11;
	public				$PV = 8;
	public				$name = "Kranhcrash";
	public				$price = 2500;
	public				$faction="Orcs";

	public function		__construct(){}
	
}

?>