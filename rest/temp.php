<?php
include_once 'db.php' ;

$email = $_REQUEST['email'];
$pass = $_REQUEST['password'];


$query = "SELECT * FROM users WHERE users.password='$pass' AND users.email='$email';" ;
$result = $conn->query($query);
if($result->num_rows > 0){
	$result_array["status"] = 1 ;
} else {
	$result_array["status"] = "-1" ;
}
echo json_encode($result_array);
$conn->close();
?>
