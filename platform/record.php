<?php     
    session_start();
    if(!isset($_SESSION['attemptCount']))
        $_SESSION['attemptCount']=0;
    $attemptCount=$_SESSION['attemptCount'];
    echo "Attempts done ";
    if($attemptCount>=6){
        header("Location: login.php");
    }

    include_once("connect.php");
    if(isset($_POST['username'])&&isset($_POST['password'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $_SESSION['username']=$username;
        

        $sql = "SELECT * FROM  users where username='$username'";
        $result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $row=mysqli_fetch_assoc($result);
        if($row['username']==''&&$row['username']==null){
            $sql = "INSERT INTO users (username,password) values('$username','$password')";
            $result=mysqli_query($conn, $sql) or die(mysqli_error($conn));                    
        }
    }
    else if(isset($_SESSION['wrong_attempt'])){
        if($_SESSION['wrong_attempt']==true){
            echo    '<script type="text/javascript">',
                    'alert("Wrong Password");',
                    '</script>';
        }
    }
    else{
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Keyword Matcher</title>        
	</head>
	<body style="margin-top: 150px;text-align: center; background-color:powderblue">
		<main>  
            <h2> <?php echo $_SESSION['attemptCount'];?> </h2>     
            <form onsubmit="return calculate()" action="/keysafe/platform/save.php" method="post">
                <input id="password" name="password" title="password" type="password" onkeydown="newKeyDown(event)" onkeyup="newKeyUp(event)" tabindex="0">
                <input type="hidden" name="flight_time" id="flight_time" value="">
                <input type="hidden" name="dwell_time" id="dwell_time" value="">
                <input type="hidden" name="key_sequence" id="key_sequence" value="">      
    			<input type="submit" name="login">     
            </form>
        </main>
	</body>
    <script type="text/javascript" src="../js/calc.js"></script>
</html>