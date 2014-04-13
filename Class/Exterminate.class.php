<?php 

spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});


/*
*	DALEKS SHIP
*/
class Exterminate extends Ship
{
	public				$width = 5;
	public				$height = 3;
	public				$endurance = 9;
	public 				$move = 20;
	public				$power = 12;
	public				$PV = 16;
	public				$name = "Ex-Ter-Mi-NAAATE";
	public				$price = 2000;
	public				$faction="Daleks";

	public function		__construct(){}
	
}

?>