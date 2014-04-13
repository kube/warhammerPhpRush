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
	if (isset($_POST['new_game']) && isset($_POST['name']))
		create_game($_POST['new_game'], $_POST['name']);
	if (isset($_POST['ships_ok']))
		validate($usr);
	elseif (isset($_POST['play']))
		select_game($usr); ///. FUT SELECT_VERSUS !! TO CHANGE!!!!!
	elseif (isset($_POST['faction']))
	{
		$_SESSION['user']['faction'] = $_POST['faction'];
		ship_choice($usr, $_SESSION['user']['faction']);
	}
	else if (isset($_POST['play_versus']))
	{
		unset($_SESSION['user']['versus']);
		$db = log_bdd();
		if (count($_POST) > 4)
			echo "trop de joueurs...";
		else
		{
			for($i = 0; $i <= count($_POST); $i++)
			{
				if (isset($_POST['versus'.$i]))
					$_SESSION['user']['versus'][] = $_POST['versus'.$i];
			}
			echo "Users has beed selected...";
			$db->clean_players($usr, $_SESSION['user']['versus']);
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
	<p class='big'> CHOOSE YOUR FACTION! </p>
	<form method="post" action="index.php">
		<input type="submit" name="faction" value="Orcs" class="big" \>
		<input type="submit" name="faction" value="Trolls" class="big"\>
		<input type="submit" name="faction" value="Daleks" class="big"\>
	</form>
	</div>
	<?php
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


function select_game($usr) // TO ADD : Choice between join a game (if not started) OR create a game
{
	$bdd = log_bdd();
	$all_games = $bdd->get_games();   /// A CREER
	echo "<div id='all_users'>
	<form method='post' action='index.php'>";
	$i = 0;
	foreach ($all_games as $one) {
		print_game($one, $i++);
	}
	?>
	<form method="post" action="index.php">
		<select name="nb_play">
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
		<input type="text" name="name" class="game_name" \>
		<input type="submit" name="new_game" value="Creer la game"\>
	</form>
	</div>
	<?php
}

function create_game($game, $nom)
{
	print_r($game);
	$bd = log_bdd();
	$bd->new_game($game);
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


function print_game($game, $nb)
{
	print_r($game)
	?>
	<div id="game">
		<form>
		<input type="submit" name="versus<?php echo $nb?>" value="<?php echo $game['name']?>">
		</form>
	</div>
	<?php
}

function validate($usr)
{

	if (!isset($_SESSION['user']['versus']))
		select_versus($usr);
	else if(!isset($_SESSION['user']['shop']))
		ship_choice($usr);
	else
	{
		print_r($_SESSION['user']);
		$bd = log_bdd();
		$bd->record_player($_SESSION['user']['shop'], $_SESSION['user']['faction'], $usr);
		//$bd->record_game()
		echo "<h1>YYYYOOUUU  AAARRRRRRREEE RREEAADDDYYYYYY</h1>";
	}

}

?>
