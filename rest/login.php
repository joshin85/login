<?php
include_once 'db.php';
session_start();

$email = $_REQUEST["email"];
$pass = $_REQUEST["password"];

$query = "SELECT * FROM users WHERE users.password='$pass' AND users.email='$email';" ;
$result = $conn->query($query);
if($result->num_rows > 0){
	$row = $result->fetch_assoc();
	$result_array["status"] = 1 ;
	$result_array["phone"] = $row["phone"];
	$result_array["email"] = $row["email"];
	$_SESSION["stage1"] = 'passed' ; 
} else {
	$result_array["status"] = "-1" ;
	$_SESSION["state1"] = 'failed' ;
}
echo json_encode($result_array);
$conn->close();
?>
