<?php
include_once "globals.php";

session_start();
//Session variables
$stage1 = $_SESSION['stage1'];

//Request variables
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];

if($stage1 == "passed"){
	$url = $loadPath . "rest/tokenGenerator.php";
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, "email=$email&phone=$phone");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$server_response = curl_exec($curl);
//	echo $server_response;
//	echo "beggining spin";
	//query and spinlock until value in db changes
	$url = $loadPath . "rest/tokenSet.php";
	$spin = curl_init($url);
        curl_setopt($spin, CURLOPT_POST, 1);
        curl_setopt($spin, CURLOPT_POSTFIELDS, "email=$email&phone=$phone");
        curl_setopt($spin, CURLOPT_RETURNTRANSFER, true); 
	$server_response = curl_exec($spin);	
//	$server_responce["token"];
//	$query = "UPDATE users SET users.token='$token' WHERE users.email='$email' AND users.phone='$phone';";
	echo $server_response;	


//	curl_estopt_array($curl, array(
//		CURLOPT_EMAIL => $email,
//		CURLOPT_PHONE => $phone
//	));

}
//echo $resp;
?>
