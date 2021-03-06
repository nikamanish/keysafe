var key_sequence = [];
var time_stamp = [];
var flight_time = [];
var prev_down_time = null;
var key_press_sequence = [];

function newKeyDown(e)
{
	var keynum = e.which || e.keyCode;
	if(keynum != 13){
		key_sequence.push(keynum);
		time_stamp.push({
		"down": new Date().getTime(),
		"up": null
	});
	var current_down_time = new Date().getTime();
	key_press_sequence.push(keynum);
	console.log(keynum)
	}
}

function newKeyUp(e)
{
	var flag;
	var keynum = e.which || e.keyCode;
	if(keynum != 13){
		var arrayLength = key_sequence.length;
		for (var i = 0; i < arrayLength; i++) {
			if(key_sequence[i] == keynum){
				flag = i;
			}
		}
		time_stamp[flag]["up"] = new Date().getTime();
		key_press_sequence.push(keynum);
	}
}

function calculate(){
	var arrayLength = key_sequence.length;
	var dwell_time = [];
	for (var i = 0; i < arrayLength; i++) {
		dwell_time[i] = time_stamp[i]["up"] - time_stamp[i]["down"];
		if(i != 0){
			flight_time[i] = time_stamp[i]['down'] - time_stamp[i-1]['down'];
		}

	}
	arrayLength = key_press_sequence.length;
	for (var i = 0; i < arrayLength; i++) {
		key_press_sequence[i] = (String.fromCharCode(key_press_sequence[i]));
	}

	$("#flight_time").val(flight_time.slice(1).join());
	$("#dwell_time").val(dwell_time.slice(0,-1).join());
	$("#key_press_sequence").val( key_press_sequence.join());
}

function getRandomColor() {
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++ ) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}