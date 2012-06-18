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
	$slug = $_POST['slug'];

//
// Convert form data into JSON format for submission to RESTful API
//	

//$array = array("title" => $title, "url" => $url);
//echo	$json_string = json_encode($array);
//echo "<br>";
	
/*echo $json_string = '{ 
		\'title\' : \''.$title.'\', 
		\'url\' : \''.$url.'\', 
		\'slug\' : \''.$slug.'\' 
		}';
*/

echo $json_string = 'title='.$title.'&url='.$url;

//
// Submit JSON data to API
//

$ashuri = 'https://ashapi.heroku.com/videos';

$ch = curl_init($ashuri);
curl_setopt($ch, CURLOPT_USERPWD, "jsandahl:d598d6e400fb796ab23e39288bfd63d0");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, POST);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "title=$title&url=$url");
$response = curl_exec($ch);

if (curl_errno($ch)) {
	$error = curl_error($ch);
	echo "<br>errors:" . $error. "<br>";	
} else {
	echo "<br>no curl errors<br>";
}
$status = curl_getinfo($ch);
echo "<br>status is:" . print_r($status) ."<br>";
curl_close($ch);




} else {
	
	echo "Please enter a title for your video!";
	
}

?>
</HTML>