var key_sequence = [];
var time_stamp = [];
var key_press_sequence = [];
var shiftClass=0;
var backspacePressed=false;

function newKeyDown(e)
{	
	var keynum = e.which || e.keyCode;
	if(keynum==8){
		backspacePressed=true;
		alert("Backspace Pressed. Reloading");
		location.reload();
	}
	else{

		if((e.key + e.location)=="Shift1"){
			shiftClass=1;
		}
		else if((e.key + e.location)=="Shift2"){
			shiftClass=2;
		}	
		key_sequence.push(keynum);
		time_stamp.push({
			"down": new Date().getTime(),
			"up": null
		});
		key_press_sequence.push(keynum);					
	}
}

function newKeyUp(e)
{
	var flag;	
    var keynum = e.which || e.keyCode;
	var arrayLength = key_sequence.length;
	for (var i = 0; i < arrayLength; i++) {
		if(key_sequence[i] == keynum){
			flag = i;
		}
	}
	time_stamp[flag]["up"] = new Date().getTime();
	key_press_sequence.push(keynum);
}

function calculate(){
	var arrayLength = key_sequence.length;
	var flight_time = [];
	var dwell_time = [];

	if (arrayLength==0) {
		return false;
	}


	if(!backspacePressed){
		for (var i = 0; i < arrayLength; i++) {
			dwell_time[i] = time_stamp[i]["up"] - time_stamp[i]["down"];
			
			console.log(time_stamp[i]["down"] + " " + time_stamp[i]["up"])
			if(i != 0){
				flight_time[i] = time_stamp[i]['down'] - time_stamp[i-1]['down'];
			}
		}

		if(dwell_time[arrayLength-1]<0)
			dwell_time[arrayLength-1]=101;

		arrayLength = key_press_sequence.length;
		for (var i = 0; i < arrayLength; i++) {
			key_press_sequence[i] = (String.fromCharCode(key_press_sequence[i]));
		}

		key_press_sequence.push(shiftClass);
		document.getElementById("flight_time").value=flight_time.slice(1,-1).join();
		document.getElementById("dwell_time").value=dwell_time.slice(0,-1).join();
		document.getElementById("key_sequence").value=key_press_sequence.join();

	}
	else{
		console.log("calculate returns false");
		backspacePressed=false;
		return false;
	}
}

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}