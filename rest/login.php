<?php
$servername = "localhost";
$username = "root";
$password = "symelosh";
$dbname = "users";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$email = $_REQUEST['email'];
$pass = $_REQUEST['password'];

if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM users WHERE users.password='$pass' AND users.email='$email';" ;
$result = $conn->query($query);
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$result_array[] = $row ;
		$result_array["status"] = 1 ;
	}
} else {
	$result_array["status"] = "-1" ;
}
echo json_encode($result_array);
$conn->close();
?>
