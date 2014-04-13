<?php 
spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});

class Shop
{
	private $_flouz = 15000;
	private $_nbShip = 0;
	//Ship  => price;
	private $_ships = array();
	private $_flotte = array();
	
	const MAX_SHIP = 6;
	public function		__construct($faction)
	{
		if ($faction == "Orcs")
			$this->_ships = array(
		'Cruiser' => new Cruiser,
		'Segv' => new Segv,
		'Kranhcrash' => new Kranhcrash,
		'Raklefon' => new Raklefon);
		else if ($faction == "Trolls")
			$this->_ships = array(
		'Wakawaka' => new Wakawaka,
		'Kiwikiwi' => new Kiwikiwi,
		'Bimbamboom' => new Bimbamboom,
		'Tavutmor' => new Tavutmor);
		elseif ($faction == "Daleks")
			$this->_ships = array(
		'Orbitator' => new Orbitator,
		'Exterminate' =>  new Exterminate,
		'Explain' => new Explain,
		'Realitybomb' => new Realitybomb);
		else
			return false;
	}

	public function hydrate($kwargs)
	{
		$this->_flouz = $kwargs['flouz'];
		$this->_nbShip = $kwargs['nbShip'];
		if (!is_array($kwargs['flotte']))
			return false;
		foreach ($kwargs['flotte'] as $v) {
			$this->_flotte[] = $v;
		}
	}

	public function print_shop()
	{
		?>
		<div id='shop'>
			<div id='infos'>
				<p>Flouz you have : <?php echo $this->_flouz; ?></p>
				<p>Ships in your Flotte : <?php echo$this->_nbShip; ?></p>
			</div>
			<div id='to_buy'>
				<?php 
				echo $this->print_ships(); 
				?>
			</div>
		</div>
		<?php
	}

	private function print_ships()
	{
		foreach ($this->_ships as $key => $v)
		{
			$v = new $key;
			?>
			<div id="one_ship">
				<div class="name">
					<?php echo $v->name; 
					echo "<br />Cost :"; 
					echo $v->price; ?>
				</div>
				<?php
				if ($this->_flouz >= $v->price)
					echo "<div class='ok'>";
				else
					echo "<div class='not'>";
					$this->print_stat($v);
					$this->form_shop($v); ?>
				</div>
			</div>
			<?php
		}
	}
	

	public function buy($name)
	{
		if (class_exists($name))
			$ship = new $name;
		if ($this->_flouz >= $ship->price && $this->_nbShip < self::MAX_SHIP) {
			$this->_flouz -= $ship->price;
			$this->_flotte[] = $ship;
			$this->_nbShip++;
		}
	}

	public function delete($name)
	{
		if (class_exists($name))
			$ship = new $name;
		foreach ($this->_flotte as $k => $v) {
			if ($v == $ship)
			{
				unset($this->_flotte[$k]);
				$this->_flouz += $this->_ships[$name]->price;
				$this->_nbShip--;
				return;
			}
		}
	}

	public function get_array_user()
	{
		return(array('flouz' => $this->_flouz, 'nbShip' => $this->_nbShip, 'flotte' => $this->_flotte));
	}

	public function get_flotte()
	{
		$ret = $this->_ships;
		foreach ($ret as $key => $value) {
			$ret[$key] = 0;
		}
		foreach ($this->_flotte as $k => $v) {
			$ret[$v]++;	
		}
		return $ret;
	}

	private function print_stat($stat)
	{
		echo "<div class='img'> taille : ".$stat->width." / ".$stat->height."<br/>PV: ".$stat->PV."<br/>PP: ".$stat->power."<br/>Speed: ".$stat->move."<br/>Manoeuvre: ".$stat->endurance."<br/></div>";
	}

	public function print_flotte()
	{
		foreach ($this->_flotte as $k => $v)
			echo "<h4> ".$v->name ."</h4>";
	}

	public function doc()
	{
		return (file_get_contents('Shop.doc.txt'));
	}

	private function form_shop($v)
	{
		?>
		<div id='buy'>
			<form action="index.php" method="post" class="add">
				<input type="submit" value="add" name="add">
				<input type="hidden" value="<?php echo get_class($v);?>" name="ship">
			</form>
			<form action="index.php" method="post" class="del">
				<input type="submit" value="del" name="del">
				<input type="hidden" value="<?php echo get_class($v);?>" name="ship">
			</form>
		</div>
		<?php					
	}
}

?>