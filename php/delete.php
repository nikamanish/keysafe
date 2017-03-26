<?php
		include('connect.php');
		$sql = "DELETE FROM flight_time" ;
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

		$sql = "DELETE FROM dwell_time" ;
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		
		$sql = "DELETE FROM key_sequence" ;
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
?>