<?php

session_start();
unlink("1.game");
header("Location: index.php");

?>