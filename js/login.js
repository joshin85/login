//The required length for any given inputfield
var validator = {text:1,password:8}

$(function(){
	$(".login-box input:button").on("click", function(){
		var error =0;
		error += inputValidation($(".login-box input:text"), 1);
		error += inputValidation($(".login-box input:password"), 8);
		if(error == 0){
			var password = $(".login-box input[type='password']").val();
			var email = $(".login-box input[type='text']").val();
			var formdata = new FormData();
			formdata.append("email", email);
			formdata.append("password", password);
			doPost("../rest/login.php", "post", loginCallback, formdata);		

		}
	});
	$(document).keypress( function(e){
		if(e.which == 13){
			$(".login-box input[type='button']").click();	
		}
	})
	$("input").on('keyup', function(){
		switch($(this).attr("type")) {
			case "text":
				inputValidation($(this), 1);	
			case "password":
				inputValidation($(this), 8);
		}
			
	});
	$("body").append('<div class="loader-container fade-out" style="display:none"><span class="fa fa-lock fa-5x"></span><div class="loader">Loading...</div><div class="loader-text">Waiting for Secondary Authentication</div></div>');
	
});
function fullLoginCallback(respObj){
	respObj = JSON.parse(respObj);
	if(respObj.status == 1){
		$(".loader-container").remove();
		window.location = "done.html";	
	} else {
		window.location = "fail.html";
	}
}
function loginCallback(respObj){
	respObj = JSON.parse(respObj);
	if(respObj.status == 1){
		$(".login-box").addClass("fade-out");
		appendSpinner();
		var formdata = new FormData();
		formdata.append("email", respObj.email);
		formdata.append("phone", respObj.phone);
		doPost("../rest/requestToken.php", "post", fullLoginCallback, formdata);
	} else	 {
		$(".login-box input:text, .login-box input:password").addClass("error");
	}
}


function inputValidation(target){
	var error = 0;
	var min = validator[target.attr("type")];
	if(target.val().length < min){
			target.addClass("error");
			error++;
			}
		else 
			target.removeClass("error");
	return error;
}

function appendSpinner(){
	if($(".spinner").length == 0)
		//$("body").append('<div class="loader-container off-screen"><span class="fa fa-lock fa-5x"></span><div class="loader">Loading...</div></div>');
	//$(".loader-container")[0].offsetWidth;
//	$(".loader")[0].offsetWidth;
	$(".loader-container").show();
	$(".loader-container").removeClass("fade-out");
}

function doPost(url, method, callback, data){
	phr = new XMLHttpRequest();
	phr.open(method, url, true);
	phr.send(data);
	phr.onreadystatechange = function() {
		if (phr.readyState == 4 && phr.status == 200) {
			callback(phr.responseText);
		}
	}
}
