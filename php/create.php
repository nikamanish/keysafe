<?php
	include("connect.php");
	$sql = "SELECT key_time FROM flight_time WHERE user_id=2" ;
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$string = implode(",", range(0, 9));
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

$sql = "SELECT key_time FROM dwell_time WHERE user_id=2" ;
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$string = implode(",", range(0, 9));
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