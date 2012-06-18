<!DOCTYPE html>

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

//
// Convert form data into JSON format for submission to RESTful API
//	
	
	$json_string = '{ "title":"'.$title.'", "url":"'.$url.'"  }';

//
// Submit JSON data to API
//

$ashuri = 'https://ashapi.heroku.com/videos/';

$ch = curl_init($ashuri);
curl_setopt($ch, CURLOPT_USERPWD, "jsandahl:d598d6e400fb796ab23e39288bfd63d0");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type:application/json"));
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_string);
$response = curl_exec($ch);

if (curl_errno($ch)) {
	$error = curl_error($ch);
	echo "errors:" . $error;	
} else {
	echo "no errors<br>";
}
$status = curl_getinfo($ch);
echo "<br>status is:" . print_r($status) ."<br>";
echo "<br>response is:" . $response;
curl_close($ch);




} else {
	
	echo "Please enter a title for your video!";
	
}

?>
</HTML>