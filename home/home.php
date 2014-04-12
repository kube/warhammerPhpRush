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
		$sv = array('login' => 'root', 'passwd' => 'public6542ENEMY', 'create' => 'OK');
		$bd = new Mysql($sv);
		$_SESSION['co'] = serialize($sv);
	}
	else
	{
		?>	
		<div id="install">
			<h3>Installez VoisinWar42K!</h3>
			<form method="post" action="index.php">
				<input type="text" name="login" placeholder="login BDD"\>
				<input type="password" name="passwd" placeholder="Password"\>
				<input type="submit" value="Installez la Bdd." name="install">
			</form>
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
	echo "<h3>Welcome ".$user['login']." !</h3>";
	?>
	<form method="post" action="index.php">
		<input type="submit" name="log_out" value="Log Out" \>
	</form>
	<?php
	chat($user['login']);
}

function form_log()
{
	?>
	<form method="post" action="index.php">
			<input type="text" name="login" placeholder="Login" \>
			<input type="password" name="passwd" placeholder="Password" \>
			<input type="submit" value="Log_in" name="log_in" \>
	</form>
	<form method="post" action="index">
		<input type="submit" name="destroy" value="Creer un Nouveau Compte" \>
	</form>
	<?php
}


function subscribe()
{
	?>
	<form method="post" action="index.php">
		<input type="text" name="login" placeholder="Login" \>
		<input type="text" name="mail" placeholder="Mail" \>
		<input type="password" name="passwd" placeholder="Password" \>
		<input type="password" name="passwd_v" placeholder="Check Password" \>
		<input type="submit" value="Creer un compte." name="add_user" \>
	</form>
	<?php
}

?>