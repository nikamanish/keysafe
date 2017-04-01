<?php
	setcookie("username", $_POST['username'], time() - 1, "/");
	header("Location: ../index.php");
?>