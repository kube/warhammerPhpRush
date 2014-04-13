<?php 

/**
* 
*/
class Shop
{
	private $_flouz = 15000;
	private $_nbShip = 0;
	//Ship  => price;
	private $_ships = array();
	private $_flotte = array();
	
	const MAX_SHIP = 5;
	public function		__construct($faction)
	{
		echo $faction;
		if ($faction == "Orcs")
			$this->_ships = array(
		'cruiser' => 1000,
		'segv' => 2000,
		'father_lord' => 3000,
		'destructor' => 3500,
		'death_killer' => 5000);
		else if ($faction == "Trolls")
			$this->_ships = array(
		'WakaWaka' => 1000,
		'KiwiKiwi' => 2000,
		'BimBamBOOM' => 3000,
		'CoupCoup' => 3500,
		'TavuTMor' => 5000);
		elseif ($faction == "Daleks")
			$this->_ships = array(
		'spoutnik' => 1000,
		'orbitator' => 2000,
		'exterminate' => 3000,
		'explain' => 3500,
		'RealityBomb' => 5000);
		else
			$this->_ships = array(
		'spoutnik' => 1000,
		'orbitator' => 2000,
		'exterminate' => 3000,
		'explain' => 3500,
		'RealityBomb' => 5000);
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
				<?php echo $this->print_ships(); ?>
			</div>
		</div>
		<?php
	}

	private function print_ships()
	{
		foreach ($this->_ships as $key => $value) {
			?>
			<div id="one_ship">
				<div class="name">
					<?php echo $key;?><br />
					Cost : <?php echo $value;?>
				</div>
				<?php
				if ($this->_flouz >= $value)
					echo "<div class='ok'>";
				else
					echo "<div class='not'>";
				?>
					<div class='img'> <?php $this->print_stat($key)?></div>
					<div id='buy'>
						<form action="index.php" method="post" class="add">
							<input type="submit" value="add" name="add">
							<input type="hidden" value="<?php echo $key;?>" name="ship">
						</form>
						<form action="index.php" method="post" class="del">
							<input type="submit" value="del" name="del">
							<input type="hidden" value="<?php echo $key;?>" name="ship">
						</form>
						
					</div>
				</div>
			</div>
			<?php
		}
	}


	public function buy($name)
	{
		if (array_key_exists($name, $this->_ships)  && $this->_flouz >= $this->_ships[$name] && $this->_nbShip < self::MAX_SHIP) {
			$this->_flouz -= $this->_ships[$name];
			$this->_flotte[] = $name;
			$this->_nbShip++;
		}
	}

	public function delete($name)
	{
		if (array_key_exists($name, $this->_ships)  && in_array($name, $this->_flotte)) {
			$this->_flouz += $this->_ships[$name];
			unset($this->_flotte[array_search($name, $this->_flotte)]);
			$this->_nbShip--;
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

	private function print_stat($ship)
	{
		switch ($ship) {
			case 'cruiser':
				echo "taille : 4 * 1<br/>PV: 50<br/>PP: 3<br/>Speed: 17<br/>Manoeuvre: 2<br/>Weapons: lance-pierre, shotgun";
				break;
			case 'segv':
				echo "taille : 5 * 2<br/>PV: 150<br/>PP: 6<br/>Speed: 20<br/>Manoeuvre: 8<br/>Weapons: bus_error()";
				break;
			case 'father_lord':
				echo "taille : 4 * 1<br/>PV: 50<br/>PP: 3<br/>Speed: 17<br/>Manoeuvre: 2<br/>Weapons: lance-pierre, shotgun";
				break;
			case 'destructor':
				echo "taille : 4 * 1<br/>PV: 50<br/>PP: 3<br/>Speed: 17<br/>Manoeuvre: 2<br/>Weapons: lance-pierre, shotgun";
				break;
			case 'death_killer':
				echo "taille : 4 * 1<br/>PV: 50<br/>PP: 3<br/>Speed: 17<br/>Manoeuvre: 2<br/>Weapons: lance-pierre, shotgun";
				break;
			default:
				echo "taille : 4 * 1<br/>PV: 50<br/>PP: 3<br/>Speed: 17<br/>Manoeuvre: 2<br/>Weapons: lance-pierre, shotgun";
		}
	}
}

?>