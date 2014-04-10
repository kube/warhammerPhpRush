<?php

session_start();
unset($_SESSION['game']);
header("Location: index.php");

?>