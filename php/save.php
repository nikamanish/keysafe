<?php 
	include_once("connect.php");
	$flight_time = mysqli_real_escape_string($conn, $_POST['flight_time']);
	$dwell_time = mysqli_real_escape_string($conn, $_POST['dwell_time']);
	$key_press_sequence = mysqli_real_escape_string($conn, $_POST['key_press_sequence']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$username=$_COOKIE['username'];

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
	}
	header("Location: login.php");
?>