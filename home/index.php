<?php 
session_start();
error_reporting(E_ALL);
ini_set("display_errors", "On");

require_once("mysql.php");
require_once("home.php");
require_once("chat.php");
spl_autoload_register(function ($class) {
   require_once '../Class/'.$class . '.class.php';
});

?>
<!DOCTYPE html>
<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js">
	</script>
	<title>VoisinWar42K</title>
	<meta http-equiv='Content-Type' content='text/html' charset='utf-8'\>
	<link rel='stylesheet' type='text/css' href='style.css'>
	<script type="text/javascript">

	
	$(document).ready(function() {
	setInterval(function() {
		$('#messages').load('get_chat.php');
	}, 300); 
});
	function scroll()
	{
		alert("scroll");
		var height = document.getElementById('messages').scrollHeight;
		document.getElementById('messages').scrollTo(0, height);
	}

	</script>
</head>
<body>
<div id="header">
<h2> Voisin WAR 42K </h2>
<h4> Welcome in a new 42 neighborhood...</h4>
</div>
<div id="user_block">
<?php
	if (isset($_POST['add_user']))
		new_user();
	else if (!isset($_SESSION['co']))
		install();
	else if (isset($_POST['log_in']))
		log_in($_POST['login'], $_POST['passwd']);
	else if (!isset($_SESSION['user']) || isset($_POST['destroy']))
	{
		if (isset($_POST['destroy']))
			subscribe();
		else
			form_log();
	}
	else if (isset($_SESSION['user']) && !isset($_POST['log_out']))
	{
		$bdd = log_bdd();
		$user = $bdd->get_login($_SESSION['user']['login']);
		welcome_user($user);
	}
	else if (isset($_POST['log_out']) && isset($_SESSION['user']))
	{
		unset($_SESSION['user']);
		form_log();
	}
?>
</div>
</body>
</html>