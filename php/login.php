<?php
    if(!isset($_COOKIE['username'])){
        header("Location: ../index.php");
    }   
?>
<!DOCTYPE html> 
<html>
	<head>
		<title>Keyword Matcher</title>
	</head>
	<body>
		<main>
            <form onsubmit="return calculate()" action="save.php" method="post" style="display: inline;">
                <input id="password" type="password" name="password" onkeydown="newKeyDown(event)" onkeyup="newKeyUp(event)">
                <input type="hidden" name="flight_time" id="flight_time" value="">
                <input type="hidden" name="dwell_time" id="dwell_time" value="">
                <input type="hidden" name="key_press_sequence" id="key_press_sequence" value="">
				<input type="submit" name="submit">     
            </form>
            <button><a style="color: black; text-decoration: none;" href="logout.php">Logout</a> </button> 
            <canvas id="flight_time_canvas" width="500" height="200"></canvas>
            <canvas id="dwell_time_canvas" width="500" height="200"></canvas>
        </main>


	</body>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script type="text/javascript" src="../js/calc.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
    <script type="text/javascript">
        var ftime = document.getElementById("flight_time_canvas");
        var dtime = document.getElementById("dwell_time_canvas");
        <?php include("create.php") ?>        
    </script>
</html>