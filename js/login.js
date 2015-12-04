//The required length for any given inputfield
var validator = {text:1,password:8}

$(function(){
	$(".login-box input:button").on("click", function(){
		var error =0;
		error += inputValidation($(".login-box input:text"), 1);
		error += inputValidation($(".login-box input:password"), 8);
		if(error == 0){
		$(".login-box").addClass("fade-out");
		appendSpinner();
		}
	});
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
