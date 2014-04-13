<?php 

spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});


/*
*	DALEKS SHIP
*/
class Explain extends Ship
{
	public				$width = 3;
	public				$height = 1;
	public				$endurance = 6;
	public 				$move = 24;
	public				$power = 7;
	public				$PV = 12;
	public				$name = "Explain";
	public				$price = 1000;
	public				$faction="Daleks";
	
	public function		__construct(){}
}

?>