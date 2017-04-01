<!DOCTYPE html>
<html>
	<head>
		<title>Keyword Matcher</title>
	</head>
	<body style="margin-top: 300px;text-align: center; background-color:powderblue">
		<main>       
			<?php
			    if(isset($_POST['login'])){
			        setcookie("username", $_POST['username'], time() + (86400 * 30 *12), "/");
			        header("Location: php/login.php");
			    }
			    if(isset($_COOKIE['username'])){
					header("Location: php/login.php");
				}
			?>     
            <form action="index.php" method="post">
            	<p>Username</p>
				<input id="username" name="username" title="username" type="text">
				<p>Password</p>
                <input id="password" name="password" title="password" type="password">
                <br/>
				<input type="submit" name="login">     
            </form>
        </main>
	</body>
</html>