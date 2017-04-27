<?php
    
  session_start();
  $_SESSION['attemptCount']=0;

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Keyword Matcher</title>
	</head>
	<body style="margin-top: 150px;text-align: center; background-color:powderblue">
		<main>       
          <form onsubmit="return validate()" action="/keysafe/platform/record.php" method="post">
   		        <p>Password should contain</p>
   		        <ul style="text-align: left;margin-left: 550px;">
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
              <br/>
				      <input type="submit" name="login">
              <br/>
              <br/>
              <button><a style="color: black; text-decoration: none;" href="login.php">Login</a></button>
          </form>
    </main>
	</body>
	<script type="text/javascript" src="../js/register.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    
</html>