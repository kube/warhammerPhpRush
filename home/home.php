<?php 

function log_bdd()
{
	$co = unserialize($_SESSION['co']);
	$co['co'] = 'ok';
	unset($co['create']);
	return (new Mysql($co));
}

function install()
{
	if (isset($_POST['install']))
	{
		$sv = array('login' => $_POST['login'], 'passwd' => $_POST['passwd'], 'host' => $_POST['host'], 'create' => 'OK');
		$bd = new Mysql($sv);
		$_SESSION['co'] = serialize($sv);
		?><script type="text/javascript">location.reload();</script><?php
	}
	else
	{
		?>	
		<div id="install">
			<div id="aff">
				<h3>Installez VoisinWar42K!</h3>
				<form method="post" action="index.php">
					<input type="text" name="host" placeholder="Host (local.42.fr)"\>
					<input type="text" name="login" placeholder="login BDD"\>
					<input type="password" name="passwd" placeholder="Password"\>
					<input type="submit" class="submit" value="Installez la Bdd." name="install">
				</form>
			</div>
		</div>
		<?php
	}
}

function new_user()
{
	$bdd = log_bdd();
	if ($_POST['passwd'] != $_POST['passwd_v'])
	{
		echo ("<h4>Paswords differents</h4>".PHP_EOL);
		return (false);
	}
	else
	{
		$pass = hash("whirlpool", $_POST['passwd']);
		$user = htmlspecialchars($_POST['login']);
		if ($bdd->check_login($user) != false)
		{
			echo "<h4>Login deja enregistré.</h4>".PHP_EOL;
			form_log();
			return false;
		}
		$mail = htmlspecialchars($_POST['mail']);
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
			echo "<h4>Ceci n'est pas une adresse mail.</h4>".PHP_EOL;
			form_log();
			return false;
		}
	}
	if ($bdd->add_user(array('login' => $user, 'passwd' => $pass, 'mail' => $mail)))
	{
		$_SESSION['user'] = array('login' => $user);
		welcome_user($bdd->get_login($user));
		return true;
	}
	else
		return false;
}

function log_in($login, $passwd)
{
	$bdd = log_bdd();
	$user = $bdd->check_login($login);
	if ($user == false)
	{
		echo "<h4> Login inexistant.</h4>".PHP_EOL;
		form_log();
		return false;		
	}
	else
	{
		$user = $bdd->get_login($login);
		if (hash('whirlpool', $passwd) == $user['passwd'])
		{
			$_SESSION['user'] = array('login' => $login);
			welcome_user($user);
		}
		
	}
}


function welcome_user($user)
{
	$usr = $user['login'];
	echo "<h3>Welcome ".$user['login']." !</h3>";
		?>
		<form method="post" action="index.php">
			<input type="submit" class="submit" name="play" value="Play" \>
			<input type="submit" class="submit" name="log_out" value="Log Out" \>
		</form>
		<?php
	if (isset($_POST['nb_play']) && isset($_POST['name']))
		create_game($_POST['nb_play'], $_POST['name']);
	if (isset($_POST['ships_ok']))
		validate($usr);
	elseif (isset($_POST['play']))
		select_game($usr); ///. FUT SELECT_VERSUS !! TO CHANGE!!!!!
	elseif (isset($_POST['faction']))
	{
		$_SESSION['user']['faction'] = $_POST['faction'];
		ship_choice($usr, $_SESSION['user']['faction']);
	}
	else if (isset($_POST['game_select']))
	{
		unset($_SESSION['user']['game']);
		if (count($_POST) > 4)
			echo "trop de joueurs...";
		else
		{
			for($i = 0; $i <= count($_POST); $i++)
			{
				if (isset($_POST['game'.$i]))
				{
					$_SESSION['user']['game'] = $_POST['game'.$i];
					break;
				}
			}
			echo "Game \"". $_SESSION['user']['game'] ."\" has been selected...";
			faction_choice($usr);
		}
	}
	elseif (isset($_SESSION['user']['faction']))
		ship_choice($usr, $_SESSION['user']['faction']);
	chat($user['login']);
	
}

function faction_choice($usr)
{
	?>
	<div id='faction'>
	<p class='big_head'> CHOOSE YOUR FACTION! </p>
	<form method="post" action="index.php">
		<input type="submit" name="faction" value="Orcs" class="big" \>
		<input type="submit" name="faction" value="Trolls" class="big"\>
		<input type="submit" name="faction" value="Daleks" class="big"\>
	</form>
	</div>
	<?php
	if (isset($_SESSION['user']['shop'])){unset($_SESSION['user']['shop']);}
}

function ship_choice($usr, $faction)
{
	$shop = new Shop($faction);
	if (isset($_SESSION['user']['shop']))
	{
		$saved = unserialize($_SESSION['user']['shop']);
		$shop->hydrate($saved);
		$flotte = $shop->get_flotte();
		foreach ($flotte as $k => $v) {
			if ($v != 0) {
				echo "<h4> $k : $v </h4>";
			}
		}
	}
	$shop->print_shop();
	if(isset($_POST['add']) && isset($_POST['ship']))
	{
		$shop->buy($_POST['ship']);
		?><script type="text/javascript">location.reload();</script><?php
	}
	else if(isset($_POST['del']) && isset($_POST['ship']))
	{
		$shop->delete($_POST['ship']);
		?><script type="text/javascript">location.reload();</script><?php
	}
	$_SESSION['user']['shop'] = serialize($shop->get_array_user());
	?>
	<form method="post" action="index.php">
		<input type="submit" name="ships_ok" value="I'm ready to fight!" class="submit final" \>
	</form>
	</div>
	<?php
}


function select_game($usr)
{
	$bdd = log_bdd();
	$all_games = $bdd->get_games();
	echo "<div id='all_users'>
		<h2> SELECT GAME FROM FOLLOWING WHERE 1 </h2>
	<form method='post' action='index.php'>";
	$i = 0;
	foreach ($all_games as $one) {
		print_game($one, $i++);
	}
	?>
	<form method="post" action="index.php">
		<select name="nb_play" id="nb_play">
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
		<input type="text" name="name" class="game_name" \>
		<input type="submit" name="new_game" value="Creer la game" class="submit" \>
	</form>
	</div>
	<?php
}

function create_game($game, $nom)
{
	$bd = log_bdd();
	$bd->new_game($game, $nom);
}

function form_log()
{
	?>
	<form method="post" action="index.php">
			<input type="text" name="login" placeholder="Login" \>
			<input type="password" name="passwd" placeholder="Password" \>
			<input type="submit" class="submit" value="Log_in" name="log_in" \>
	</form>
	<form method="post" action="index.php">
		<input type="submit" class="submit" name="destroy" value="Creer un Nouveau Compte" \>
	</form>
	<?php
}


function subscribe()
{
	if (isset($_POST['not_new']))
		form_log();
	?>
	<form method="post" action="index.php">
		<input type="text" name="login" placeholder="Login" \>
		<input type="text" name="mail" placeholder="Mail" \>
		<input type="password" name="passwd" placeholder="Password" \>
		<input type="password" name="passwd_v" placeholder="Check Password" \>
		<input type="submit" class="submit" value="Creer un compte." name="add_user" \>
	</form>
	<form method="post" action="index.php">
		<input type="submit" class="submit" name="not_new" value="Log IN" \>
	</form>
	<?php
}

function place_in_game($game)
{
	$nb = $game['nb_players'];
	for ($i=1; $i <= 4; $i++) { 
		if ($game['player'.$i] != '')
			$nb--;
		if ($nb <= 0)
			return false;
	}
	return true;
}

function print_game($game, $nb)
{
	if(!place_in_game($game))
		return false;
	?>
	<div id="game">
		<form method="post" action="index.php">
			<input type="hidden" name="game_select" \>
			<input type="submit" name="game<?php echo $nb?>" value="<?php echo $game['name']?>" class="submit">
		</form>
		<p class="rel"> this party is for <?php echo $game['nb_players']; ?> only. with :
			<?php
			for ($i=1; $i <= 4; $i++) { 
				if ($game['player'.$i])
					echo " ".$game['player'.$i]." ";
			}
			?>
	</p></div>
	<?php
}

function validate($usr)
{

	if (!isset($_SESSION['user']['game']))
		select_game($usr);
	else if(!isset($_SESSION['user']['shop']))
		ship_choice($usr);
	else
	{
		$bd = log_bdd();
		if (!$bd->record_player($_SESSION['user']['shop'], $_SESSION['user']['faction'], $usr, $_SESSION['user']['game']))
			echo "Hey! you're already in that game!";	
		else
			echo "<h1>YYYYOOUUU  AAARRRRRRREEE RREEAADDDYYYYYY</h1>";
	}

}

?>
