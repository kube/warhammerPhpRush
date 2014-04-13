<?php 

spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});


/*
*	TROLL SHIP
*/
class WakaWaka extends Ship
{
	public				$width = 6;
	public				$height = 1;
	public				$endurance = 5;
	public 				$move = 21;
	public				$power = 7;
	public				$PV = 15;
	public				$name = "WakaWaka";
	public				$price = 1000;
	public				$faction="Trolls";

	public function		__construct(){}
	
}

?>