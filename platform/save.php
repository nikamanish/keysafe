<?php 	
	include_once("connect.php");
	session_start();
	$flight_time = mysqli_real_escape_string($conn, $_POST['flight_time']);
	$dwell_time = mysqli_real_escape_string($conn, $_POST['dwell_time']);
	$key_press_sequence = mysqli_real_escape_string($conn, $_POST['key_sequence']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$username=$_SESSION['username'];

	$sql = "SELECT id,password from users where username='$username'"; 
	$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$row=mysqli_fetch_assoc($result);
	$id=$row['id'];
	$realpassword=$row['password'];

	if($password == $realpassword)
	{
		$sql = "INSERT INTO flight_time(user_id, password, key_time) VALUES($id, '$realpassword', '$flight_time')";
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

		$sql = "INSERT INTO dwell_time(user_id, password, key_time) VALUES($id, '$realpassword', '$dwell_time')" ;
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		
		$sql = "INSERT INTO key_sequence(user_id, password, sequence) VALUES($id, '$realpassword','$key_press_sequence')" ;
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$_SESSION['wrong_attempt']=false;
		if(++$_SESSION['attemptCount']==6){

			############################################################################################

			$flight_times=[[]];
			$distances=[];

			$sql = "SELECT key_time from flight_time where user_id=$id"; 
			$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
			while($row = $result->fetch_assoc()){
				array_push($flight_times,explode(",",$row['key_time']));
				echo"<br/>";
			}

			// print_r($flight_times);
			// echo "<br/>";
			// echo "<br/>";
			// echo "<br/>";
			$size=max(array_map('count',$flight_times));
			echo"SIZE: ".$size;
			echo "<br/>";
			echo "<br/>";
			echo "<br/>";
			for($i=1;$i<6;$i++){
				for($j=$i+1;$j<7;$j++){
					$dist=0;
					for($k=0;$k<$size;$k++){
						echo "IK: ".$flight_times[$i][$k];
						echo "<br/>";
						echo "JK: ".$flight_times[$j][$k];
						$dist=$dist+pow( $flight_times[$i][$k]-$flight_times[$j][$k] , 2 );
					}
					echo "<br/>";
					echo "<br/>";
					echo "<br/>";
					echo "DIST ".$dist;
					array_push($distances, sqrt($dist));
				}
			}

			$flight_time_average=(array_sum ($distances)/15);

			$sql = "UPDATE users SET flight_time_average=$flight_time_average WHERE id=$id;";
			$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

			############################################################################################

			$dwell_times=[[]];
			$distances=[];

			$sql = "SELECT key_time from dwell_time where user_id=$id"; 
			$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
			while($row = $result->fetch_assoc()){
				array_push($dwell_times,explode(",",$row['key_time']));
				echo"<br/>";
			}

			$size=max(array_map('count',$flight_times));

			for($i=1;$i<6;$i++){
				for($j=$i+1;$j<7;$j++){
					$dist=0.0;
					for($k=0;$k<$size;$k++){
						$dist+=pow ( $dwell_times[$i][$k]-$dwell_times[$j][$k] , 2 );
					}
					array_push($distances, sqrt($dist));
				}
			}

			$dwell_time_average=(array_sum ($distances)/15);

			$sql = "UPDATE users SET dwell_time_average=$dwell_time_average WHERE id=$id;";
			$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

			###########################################################################################

		}
		
	}
	else{
		$_SESSION['wrong_attempt']=true;
	}
	echo $_SESSION['attemptCount'];	
	header("Location: record.php");
?>