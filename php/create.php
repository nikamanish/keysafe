<?php
	include("connect.php");

    $username=$_COOKIE['username'];
    $sql = "SELECT id,password from users where username='$username'"; 
    $res=mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row=mysqli_fetch_assoc($res);
    $id=$row['id'];
    $password=$row['password'];
    $password_length=strlen($password)-1;

	$sql = "SELECT key_time FROM flight_time WHERE user_id='$id'" ;
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$string = implode(",", range(0, $password_length));
	echo "var fChart = new Chart(ftime, {  
    type: 'line',
    data: {
        labels: [$string],
        datasets: [";

	while($row = mysqli_fetch_assoc($res)) {
		$temp = $row['key_time'];
    	echo "{
                type: 'line',
                data: [$temp],
                fill: false,
                borderColor: getRandomColor()
            },";
    }

    echo "]
    }
});";

$sql = "SELECT key_time FROM dwell_time WHERE user_id='$id'" ;
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$string = implode(",", range(0, $password_length));
	echo "var dChart = new Chart(dtime, {
    type: 'line',
    data: {
        labels: [$string],
        datasets: [";

	while($row = mysqli_fetch_assoc($res)) {
		$temp = $row['key_time'];
    	echo "{
                type: 'line',
                data: [$temp],
                fill: false,
                borderColor: getRandomColor()
            },";
    }

    echo "]
    }
});"


?>