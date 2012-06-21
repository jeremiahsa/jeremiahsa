<!DOCTYPE html>
<head>
<title>Views</title>
</head>
<body>

<?php
//
//	The getViews function connects to the API to retrieve the current view count;
//

function getViews($ashapi, $video_id) {
	//echo "ashuri:".$ashapi."video_id:".$video_id;
	$ch = curl_init($ashapi);
	curl_setopt($ch, CURLOPT_USERPWD, "jsandahl:d598d6e400fb796ab23e39288bfd63d0");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	echo $response = curl_exec($ch);
	$array = json_decode($response);
	echo $views = $array['$video_id']->view_count;
	return $views;
}

//
//	The connectToAPI function connects to the API and updates the API based on the view count
//	retrieved from getViews(); and the video_id which was clicked when the video began playing.
//

function connectToAPI($video_id, $currentViews) {
	$ashapi = 'https://ashapi.heroku.com/videos/'.$video_id;
	
	$ch = curl_init($ashapi);
	curl_setopt($ch, CURLOPT_USERPWD, "jsandahl:d598d6e400fb796ab23e39288bfd63d0");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, PUT);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "id=$video_id&view_count=$currentViews");
	echo $response = curl_exec($ch);
}

// 	This section just checks to make sure that the clicks on the video are not more frequent than
//	once per minute.

if (isset($_GET['id'])) {
	$video_id = $_GET['id'];
	// if cookie is active, view will be ignored
	if (isset($_COOKIE[$video_id])) {
			// Cookie is set, meaning that the video has already been viewed in the past minute. Only one view per minute is permitted. 
			exit;
	} else {
	// set new cookie	
	$expire = time()+60*60;
	setcookie($video_id, $expire);
	}
}
//	URI is constructed for the API
$ashapi = 'https://ashapi.heroku.com/videos/'.$video_id.'/views';
//	current Views are retrieved
$currentViews = getViews($ashapi, $video_id) + 1;
//	Data is passed to the API
connectToAPI($video_id, $currentViews);

?>
</body>
</html>