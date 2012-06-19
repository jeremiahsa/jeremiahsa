<!DOCTYPE html>
<head>
<title>The top 10 videos</title>
</head>
<body>
<?php
	
//
//	Get top 10 videos by Views
//

if ($_GET['views'] != NULL) {
	echo '<h2>By Views</h2>';
	$ashuri = 'https://ashapi.heroku.com/videos/top10/views';
	
}

//
//	Get top 10 videos by Submission
//

else if ($_GET['submission'] != NULL) {
	echo '<h2>By Submission</h2>';
	$ashuri = 'https://ashapi.heroku.com/videos';
}

//
//	Get top 10 videos by Rating
//

else if ($_GET['byratings'] != NULL) {
	echo '<h2>By Ratings</h2>';
	$ashuri = 'https://ashapi.heroku.com/videos/top10/votes';
	
}

//
//	Get Data via cURL
//

$ch = curl_init($ashuri);
curl_setopt($ch, CURLOPT_USERPWD, "jsandahl:d598d6e400fb796ab23e39288bfd63d0");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

//
// Process returned data in an array
//

$array = json_decode($response);

//
//	Loop through the top 10 results
//
echo "<ol>";
for ($i=1; $i<=10; $i++) {
	$urlForEmbed = addEmbed($array[$i]->url);
	echo  	"<li><h3>". $array[$i]->title . "</h3>".
	 		// allow js to govern links 
			"<embed width=\"250\" height=\"120\" src=\"".$urlForEmbed."\" type=\"application/x-shockwave-flash\">" . 
			$array[$i]->url . "</embed>" .
			$array[$i]->slug .
			": (".$array[$i]->id . ") id" .
			" / (".$array[$i]->vote_tally . ") votes" .
			" / (".$array[$i]->view_count . ") views</li>";
}

function addEmbed($url) {
	$embedString = str_replace("http://www.youtube.com/watch?v=", "http://www.youtube.com/v/", $url);
	
	return $embedString;
}

function voteUp() {
	
}

function voteDown() {
	
}


?>
</body>
</html>

























