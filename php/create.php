<?php
    // Function to calculate square of value - mean
    function sd_square($x, $mean) { return pow($x - $mean,2); }  
    function sd($array) {
        return sqrt(array_sum(array_map("sd_square", $array, array_fill(0,count($array), (array_sum($array) / count($array)) ) ) ) / (count($array)-1) );
    }

	include("connect.php");
	$sql = "SELECT key_time FROM flight_time WHERE user_id=2";
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$string = implode(",", range(0, 9));
	echo "var fChart = new Chart(ftime, {
    type: 'line',
    data: {
        labels: [$string],
        datasets: [";

	while($row = mysqli_fetch_assoc($res)) {
		$temp = $row['key_time'];
        $individual_key_time = explode(',', $temp);
        $mean = array_sum($individual_key_time) / sizeof($individual_key_time);
        $sd = sd($individual_key_time);

        $max = max($individual_key_time);
        $min = min($individual_key_time);
        $normalized_array = [];
        for($i = 0; $i < sizeof($individual_key_time); $i++){
            $normalized_array[] = ($individual_key_time[$i] - $sd);
        }
        
        $normalized_array = implode(',', $normalized_array);
    	echo "{
                type: 'line',
                data: [$normalized_array],
                fill: false,
                borderColor: getRandomColor()
            },";
    }

    echo "]
    }
});";

$sql = "SELECT key_time FROM dwell_time WHERE user_id=3" ;
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$string = implode(",", range(0, 10));
	echo "var dChart = new Chart(dtime, {
    type: 'line',
    data: {
        labels: [$string],
        datasets: [";

	while($row = mysqli_fetch_assoc($res)) {
		$temp = $row['key_time'];
        $individual_key_time = explode(',', $temp);
        $max = max($individual_key_time);
        $min = min($individual_key_time);
        $normalized_array = [];
        $mean = array_sum($individual_key_time) / sizeof($individual_key_time);
        $sd = sd($individual_key_time);
        for($i = 0; $i < sizeof($individual_key_time); $i++){
            $normalized_array[] = ($individual_key_time[$i] - $sd);
        }
        
        $normalized_array = implode(',', $normalized_array);
    	echo "{
                type: 'line',
                data: [$normalized_array],
                fill: false,
                borderColor: getRandomColor()
            },";
    }

    echo "]
    }
});"


?>