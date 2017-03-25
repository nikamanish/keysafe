<?php 
	include_once("connect.php");

	$flight_time = mysqli_real_escape_string($conn, $_POST['flight_time']);
	$dwell_time = mysqli_real_escape_string($conn, $_POST['dwell_time']);
	$key_press_sequence = mysqli_real_escape_string($conn, $_POST['key_press_sequence']);

	$sql = "INSERT INTO flight_time(user_id, password, key_time) VALUES(2, 'nikamanish', '$flight_time')" ;
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	$sql = "INSERT INTO dwell_time(user_id, password, key_time) VALUES(2, 'nikamanish', '$dwell_time')" ;
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	
	$sql = "INSERT INTO key_sequence(user_id, password, sequence) VALUES(2, 'nikamanish', '$key_press_sequence')" ;
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	
	header("Location: login.php");

?>