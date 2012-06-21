<!DOCTYPE html>
<head>
<title>Views</title>
</head>
<body>

<?php

function getViews($ashuri, $video_id) {
	echo "ashuri:".$ashuri."video_id:".$video_id;
	$ch = curl_init($ashuri);
	curl_setopt($ch, CURLOPT_USERPWD, "jsandahl:d598d6e400fb796ab23e39288bfd63d0");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	echo $response = curl_exec($ch);
	$array = json_decode($response);
	echo $views = $array['$video_id']->view_count;
	return $views;
}

function connectToAPI($ashapi, $video_id, $currentViews) {
	echo "<br>ashuri: ".$ashapi." video_id: ".$video_id."current views: ".$currentViews;
	
	$ch = curl_init($ashapi);
	curl_setopt($ch, CURLOPT_USERPWD, "jsandahl:d598d6e400fb796ab23e39288bfd63d0");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, POST);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "id=$video_id&view_count=$currentViews");
	echo $response = curl_exec($ch);
}
/*
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
}*/
$video_id=147;

$ashapi = 'https://ashapi.heroku.com/videos/'.$video_id.'/views';
echo "<br>".$currentViews = getViews($ashapi, $video_id) + 1;
connectToAPI($ashapi, $video_id, $currentViews);


?>
</body>
</html>