function validate()
{

	var password=document.getElementById('password').value;
	console.log(password);
	var result= ((password.length>6)&&containsUpperCase(password)&&containsLowerCase(password)&&containsSpecialChars(password));
	console.log(result);
	if(!result){
		alert("Password is out of constraints");
	}
	return result;
}
function containsUpperCase(password){
	var flag=false;
	for (var i = 0; i < password.length ; i++) {
		if(password.charAt(i)>='A' && password.charAt(i)<='Z'){
			flag=true;
			break;
		}
	}
	console.log("UC "+flag);
	//return flag;
	return true;
}

function containsLowerCase(password){
	var flag;
	for (var i = 0; i < password.length ; i++) {
		if(password.charAt(i)>='a' && password.charAt(i)<='z'){
			flag=true;
			break;
		}
	}
	console.log("LC"+flag);
	//return flag;
	return true;
}
function containsSpecialChars(password){
	var flag;
	var format = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
	for (var i = 0; i < password.length ; i++) {
		if(format.test(password)){
			flag=true;
			break;
		}
	}
	console.log("SC "+flag);
	//return flag;
	return true;
}


