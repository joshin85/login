<?php
include_once 'db.php';


$email = $_REQUEST['email']; //isset($_REQUEST['email']) ? $_REQUEST['email'] ;
$phone = $_REQUEST['phone']; //isset($_REQUEST['phone']) ? $_REQUEST['phone'] ;
if(isset($email) && isset($phone)){
	$query = "INSERT INTO tokenRequests(email, phone, token) VALUE ('$email', '$phone', NULL);";
	$query = "INSERT INTO tokenRequests ('$email', '$phone', NULL) SELECT * FROM tokenRequests WHERE NOT EXISTS (SELECT * FROM tokenRequests WHERE tokenRequests.email='$email' AND tokenRequests.phone='$phone' AND tokenRequests.token=NULL) LIMIT 1;";
	$query = "INSERT INTO tokenRequests (email, phone, token)
SELECT * FROM (SELECT '$email', '$phone', NULL) AS tmp
WHERE NOT EXISTS (
    SELECT email FROM tokenRequests WHERE email = '$email'
) LIMIT 1;";	
//	$query = "INSERT IGNORE INTO tokenRequests VALUES ('$email', '$phone', NULL) SELECT 'email', 'phone', 'token' FROM tokenRequests;";
	if($conn->query($query) === TRUE){
		echo "Created new record";
	} else {
		echo "Error " . $query . "<br" . mysqli_error($conn);
	}
} else {
	echo "No legal values given";
}
/*
function encryptPrivate($path, $plainText){
	$fcontents = file_get_contents($path);
	$privateKey = openssl_pkey_get_private($fcontents, "symelosh");
	openssl_private_encrypt($plainText, $encrypted, $privateKey);
	return $encrypted;
} 
function encryptPublic($path, $plainText){
	$fcontents = file_get_contents($path);
	$publicKey = openssl_pkey_get_public($fcontents);
	openssl_public_encrypt($plainText, $encrypted, $publicKey);
	return $encrypted;
}
function decryptPrivate($path, $cText){
	$fcontents = file_get_contents($path);
	$privateKey = openssl_pkey_get_private($fcontents,"symelosh");
 	openssl_private_decrypt($cText, $decrypted, $privateKey);
	return $decrypted;
}
function decryptPublic($path, $cText){
	$fcontents = file_get_contents($path);
	$publicKey = openssl_pkey_get_public($fcontents);
	openssl_public_decrypt($cText, $decrypted, $publicKey);
	return $decrypted;
}*/
?>
