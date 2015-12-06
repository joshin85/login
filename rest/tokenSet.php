<?php
include_once 'db.php';
//include_once 'encrypt.php';
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$length = 22;
$token = bin2hex(openssl_random_pseudo_bytes($length));

//$query = "UPDATE tokenRequests SET tokenRequests.token='$token' WHERE tokenRequests.email='$email' AND tokenRequests.phone='$phone';";
$query = "SELECT * FROM tokenRequests WHERE tokenRequests.email='$email' AND tokenRequests.phone='$phone' AND tokenRequests.token IS NOT NULL;";
$queryDelete = "DELETE FROM tokenRequests WHERE tokenRequests.email='$email' AND tokenRequests.phone='$phone';";

if(isset($email) && isset($phone)){
	$result = $conn->query($query);
	$itter = 0;
	while($result->num_rows==0){
		if($itter == 10){
			$result_set["status"] = "-1";
			echo json_encode($result_set);
			$conn->query($queryDelete);		
			exit;
		}
		sleep(1);
		$result = $conn->query($query);
		$itter = $itter + 1;
	}
	$result_array["status"] = "1";
	$result = $conn->query($queryDelete);
	echo json_encode($result_array);
}
?>
