<?php
	if(!isset($_SESSION))
		session_start();
	if(isset($_SESSION['result'])){
	
		if($_SESSION['result']=="yes"){
			// echo    '<script type="text/javascript">',
   //                  'alert("Successfully Logged In!!!");',
   //                  '</script>';
                    session_destroy();
		}	
		else if($_SESSION['result']=="no"){
			// echo    '<script type="text/javascript">',
   //                  'alert("Login Failed!!!");',
   //                  '</script>';	
                    session_destroy();
		}
		else{
			// echo    '<script type="text/javascript">',
   //                  'alert("Wrong Password!!!");',
   //                  '</script>';	
                    session_destroy();	
		}
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Keyword Matcher</title>
		<h1 style="font-family: courier; color: #404040;">KeySafe|</h1>
	</head>
	<body style="margin-top: 100px;text-align: center; background-color:powderblue">
		<main>       
            <form onsubmit="return calculate()"  method="post" action="tally.php">
            	<p>Username</p>
                <input id="username" name="username" title="username" type="username">
                <br/>
                <br/>
				<p>Password</p>
				<input id="password" type="password" name="password" onkeydown="newKeyDown(event)" onkeyup="newKeyUp(event)">
                <br/>
                <input type="hidden" name="flight_time" id="flight_time" value="">
                <input type="hidden" name="dwell_time" id="dwell_time" value="">
                <input type="hidden" name="key_sequence" id="key_sequence" value="">      
                <br/>
				<input type="submit" name="register">     
				<button><a style="color: black; text-decoration: none;" href="register.php">Register</a></button>
            </form>
        </main>
	</body>
	<script type="text/javascript" src="../js/calc.js"></script>
</html>
