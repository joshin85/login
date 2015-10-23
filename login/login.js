$(function(){
	$(".login-box input:button").on("click", function(){
		$(".login-box").addClass("fade-out");
		appendSpinner();
	
	});
		$("body").append('<div class="loader-container fade-out" style="display:none"><span class="fa fa-lock fa-5x"></span><div class="loader">Loading...</div><div class="loader-text">Waiting for Secondary Authentication</div></div>');
});

function appendSpinner(){
	if($(".spinner").length == 0)
		//$("body").append('<div class="loader-container off-screen"><span class="fa fa-lock fa-5x"></span><div class="loader">Loading...</div></div>');
	//$(".loader-container")[0].offsetWidth;
//	$(".loader")[0].offsetWidth;
	$(".loader-container").show();
	$(".loader-container").removeClass("fade-out");
}