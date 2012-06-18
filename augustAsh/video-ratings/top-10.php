<!DOCTYPE html>

<h1>These are the top 10 videos</h1>

<?php
	
//
//	Get top 10 videos by Views
//
echo '<h2>Top 10 by Views</h2>';
$ashuri = 'https://ashapi.heroku.com/videos/top10/views';

if (isset($_POST['views'])) {

	$ashuri = 'https://ashapi.heroku.com/videos/top10/views';
	
}
//
//	Get top 10 videos by Submission
//
else if (isset($_POST['submission'])) {
	
	$ashuri = 'https://ashapi.heroku.com/videos';
}
//
//	Get top 10 videos by Rating
//
else if (isset($_POST['rating'])) {
	
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
print_r($array);

//
//	Loop through the top 10 results
//

for ($i=1; $i<=10; $i++) {
	echo  	"<h3>". $array[$i]->title . "</h3>".
	 		"<a href=\"".$array[$i]->url."\">" . 
			$array[$i]->url . "</a><br>" .
			$array[$i]->slug .
			": (".$array[$i]->vote_tally . ") votes" .
			" / (".$array[$i]->view_count . ") views";
}

?>
</html>
























