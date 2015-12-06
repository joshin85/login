<?php
$privateKeyLoc = "file:///../../key/loginServer";
$publicKeyLoc = "file:///../../key/loginServer.pub";
$encPriv = encryptPublic($publicKeyLoc, "shinjo");
$decPriv = decryptPrivate($privateKeyLoc, $encPriv);
echo $encPriv;
echo "<br>---------------------------\n<br>";
echo $decPriv;

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
}
?>
