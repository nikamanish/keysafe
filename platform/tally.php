<?php

	include_once("connect.php");

	$flight_time_result=False;
	$dwell_time_result=False;
	$key_events_result=False;
	$shift_class_result=False;


	$username=$_POST['username'];
	$password=$_POST['password'];
	$flight_time_current=$_POST['flight_time'];
	$dwell_time_current=$_POST['dwell_time'];
	$key_sequence_current=mysqli_real_escape_string($conn, $_POST['key_sequence']);

	$current_flight_time_array=explode(",",$flight_time_current);
	$current_dwell_time_array=explode(",",$dwell_time_current);

	$sql = "SELECT id,password from users where username='$username'"; 
	$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$row=mysqli_fetch_assoc($result);
	$real_password=$row['password'];
	$id=$row['id'];
	
	
	if($password==$real_password){

		$sql = "SELECT sequence from key_sequence where user_id=$id"; 
		$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$row=$result->fetch_assoc();
		$key_sequence=$row['sequence'];
		echo $key_sequence_current;
		echo "<br/>";
		echo "<br/>";
		echo $key_sequence;
		echo "<br/>";
		echo "<br/>";
		echo "key_sequence-current size ".(strlen($key_sequence_current)-2);
		echo "<br/>";
		echo "<br/>";
		echo "key_sequence  ".strlen($key_sequence);

		if(strlen($key_sequence)==(strlen($key_sequence_current)-2))
			$key_events_result=True;


		######################################################################################

		echo "<br/>";
		echo "<br/>";
		echo "CurrentShiftClass ".substr($key_sequence_current, -1);
		echo "<br/>";
		echo "<br/>";
		echo "ShiftClass ".substr($key_sequence, -1);

		if(substr($key_sequence_current, -1) == substr($key_sequence, -1)){
			$shift_class_result=True;
		}		

		######################################################################################


		//$final_flight_time_array = array_fill(0, 15, 0);
		$sql = "SELECT key_time from flight_time where user_id=$id"; 
		$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
		// while($row = $result->fetch_assoc()){
		// 	$flight_time_array=explode(",",$row['key_time']);
		// 	$sizeof=sizeof($flight_time_array);
		// 	$i=0;
		// 	foreach($flight_time_array as $value){
		// 		$final_flight_time_array[$i++]+=$value;
		// 	}
		// 	// print_r($flight_time_array);
		// 	echo"<br/>";
		// }
		$row = $result->fetch_assoc();
		$final_flight_time_array=explode(",",$row['key_time']);

		$size=sizeof($final_flight_time_array);
		
		// $final_flight_time_array=array_slice($final_flight_time_array, 0, $size);
		// print_r($final_flight_time_array);

		// for($i=0;$i<$size;$i++){
		// 	$final_flight_time_array[$i]=$final_flight_time_array[$i]/$size;
		// }

		echo"<br/>";

		// print_r($final_flight_time_array);
		// print_r($current_flight_time_array);

		$fdist=0.0;
		for($i=0;$i<$size;$i++){
			$fdist+=pow ( $final_flight_time_array[$i]-$current_flight_time_array[$i] , 2 );
		}

		$fdist=sqrt($fdist);
		echo"<br/>";
		echo "FDIST: ".$fdist;


		$sql = "SELECT flight_time_average from users where id=$id"; 
		$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$row = $result->fetch_assoc();

		if($fdist<$row['flight_time_average']+25)
			$flight_time_result=True;	

		############################################################################################

		$sql = "SELECT key_time from dwell_time where user_id=$id"; 
		$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
		// while($row = $result->fetch_assoc()){
		// 	$flight_time_array=explode(",",$row['key_time']);
		// 	$sizeof=sizeof($flight_time_array);
		// 	$i=0;
		// 	foreach($flight_time_array as $value){
		// 		$final_flight_time_array[$i++]+=$value;
		// 	}
		// 	// print_r($flight_time_array);
		// 	echo"<br/>";
		// }
		$row = $result->fetch_assoc();
		$final_dwell_time_array=explode(",",$row['key_time']);

		$size=sizeof($final_dwell_time_array);
		
		// $final_flight_time_array=array_slice($final_flight_time_array, 0, $size);
		// print_r($final_flight_time_array);

		// for($i=0;$i<$size;$i++){
		// 	$final_flight_time_array[$i]=$final_flight_time_array[$i]/$size;
		// }

		echo"<br/>";

		// print_r($final_flight_time_array);
		// print_r($current_flight_time_array);

		$ddist=0.0;
		for($i=0;$i<$size;$i++){
			$ddist+=pow ( $final_dwell_time_array[$i]-$current_dwell_time_array[$i] , 2 );
		}

		$ddist=sqrt($ddist);
		echo"<br/>";
		echo "DDIST: ".$ddist;


		$sql = "SELECT dwell_time_average from users where id=$id"; 
		$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$row = $result->fetch_assoc();

		if($ddist<$row['dwell_time_average']+25)
			$dwell_time_result=True;	

		##################################################################################

		session_start();
		if($flight_time_result&&$dwell_time_result&&$key_events_result&&$shift_class_result){
			$_SESSION['result']="yes";
		}
		else{			
			$_SESSION['result']="no";
		}

	}
	else{
		echo "wrong password";  
		session_start();
		$_SESSION['result']="wrong";
	}
	#header("Location: login.php")

?>