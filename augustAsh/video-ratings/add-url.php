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
 	$slug=$_POST['slug'];

//
// Convert form data into JSON format for submission to RESTful API
//	
	
 	echo $json_Array = array('title' => $title, 'url' => $url, 'slug' => $slug);
	$json = json_encode($json_Array);
	
	echo "json:" . $json;

//
// Submit JSON data to API
//


$ashuri = 'https://ashapi.heroku.com/videos/';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ashuri);
curl_setopt($ch, CURLOPT_USERPWD, "jsandahl:d598d6e400fb796ab23e39288bfd63d0");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

if (curl_error($ch)) {
	$error = curl_error($ch);
	echo "errors:" . $error;	
} else {
	echo "no errors";
}

$response = curl_exec($ch);
echo $response;
curl_close($ch);




} else {
	
	echo "Please enter a title for your video!";
	
}

?>