<?php 

  spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});


/*
*	TROLL SHIP
*/
class Bimbamboom extends Ship
{
	public				$width = 9;
	public				$height = 4;
	public				$endurance = 12;
	public 				$move = 14;
	public				$power = 12;
	public				$PV = 18;
	public				$name = "BimBamBOOM";
	public				$price = 3000;
	public				$faction="Trolls";
	
	public function		__construct(){}	
}

?>