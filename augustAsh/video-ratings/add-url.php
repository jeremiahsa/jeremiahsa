<!DOCTYPE html>
<head>
<title>Add URL</title>
</head>
<body>
<?php

//
// Make sure that at least the title field has been set. 
//

if (isset($_POST['title'])) {

//
// Receive and declare variables from the add-url form if the title is not empty
//
	
 	$title=$_POST['title'];
  	$url=$_POST['url'];
	$slug = $_POST['slug'];

//
// Submit JSON data to API
//

$ashuri = 'https://ashapi.heroku.com/videos';

$ch = curl_init($ashuri);
curl_setopt($ch, CURLOPT_USERPWD, "jsandahl:d598d6e400fb796ab23e39288bfd63d0");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, POST);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "title=$title&url=$url");
$response = curl_exec($ch);

//
// Handle errors, in case user submits same link/title pair twice.
//

if ($response >= 1) {
	echo "Thank you for submitting a new video.";
} else if ($response == NULL){
	echo "This Video has already been submitted.";
} 

//
// Handle cURL errors nicely and usefully, though none should arise, since the code is server-side running PHP 5.3
//

if (curl_errno($ch)) {
	$error = curl_error($ch);
	echo "<br>errors:" . $error. "<br>";	
} else {

	echo "<h1>Your Link was Submitted with no errors</h1><br>";
}
curl_close($ch);

} else {

//
// In case page is visited without a POST submission
//
	
	echo "Please enter a title for your video!";
	
}

?>
</body>
</html>