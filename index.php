<!DOCTYPE html>
<html>
	<head>
		<title>Keyword Matcher</title>
	</head>
	<body style="margin-top: 150px;text-align: center; background-color:powderblue">
		<main>       
			<?php
				header("Location: platform/login.php");
			    if(isset($_POST['login'])){
			   		include_once("php/connect.php");
			   		$username=$_POST['username'];
			   		$password=$_POST['password'];

			   		$sql = "SELECT * FROM users WHERE username='$username';"; 
					$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));

					$row = mysqli_fetch_assoc($result);
					$u=$row['username'];
					if($u==null||$u==''){
			   			$sql = "INSERT into users (username,password) values('$username','$password');"; 
						$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
					}		
			        setcookie("username", $_POST['username'], time() + (86400 * 30 *12), "/");
			        header("Location: php/login.php");
			    }
			    if(isset($_COOKIE['username'])){
					header("Location: php/login.php");
				}
			?>     
            <form action="index.php" method="post">
   		        <p>Password should contain</p>
   		        <ul style="text-align: left;margin-left: 55	0px;">
  					<li>Atleast eight characters</li>
  					<li>Atleast one Upper case characters</li>
  					<li>Atleast one lower case character</li>
  					<li>Atleast one special character</li>
				</ul>
   		        <br/>
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