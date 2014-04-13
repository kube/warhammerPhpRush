<?php 

spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});


/*
*	ORC SHIP
*/
class Segv extends Ship
{
	public				$width = 5;
	public				$height = 2;
	public				$endurance = 5;
	public 				$move = 8;
	public				$power = 18;
	public				$PV = 6;
	public				$name = "SegmentationFault";
	public				$price = 1500;
	public				$faction="Orcs";
	
	public function		__construct(){}
}

?>