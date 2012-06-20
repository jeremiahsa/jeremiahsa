<!DOCTYPE html>
<head>
<title>The top 10 videos</title>
<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript">

$("#147").click(function() {
	alert('you clicked an embed');
});

</script>
<style type="text/css">
ol div {
	border:none;
	padding:none;
	margin:none;
}
</style>
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
			"<div id=\"".$array[$i]->id."\"><embed width=\"250\" height=\"250\" src=\"".$urlForEmbed."\" type=\"application/x-shockwave-flash\"><br>" . 
			$array[$i]->slug . "</embed></div>" .
			": (".$array[$i]->id . ") id" .
			" / (".$array[$i]->view_count . ") views<br>".
			" (".$array[$i]->vote_tally . ") votes" .
			'<br> 	<form id="vote_up" method="post" action="vote.php" >
					<button class="vote" name="up" id="up">
						<img src="img/vote_up.gif" />
				  	</button> 
					<button class="vote" name="down" id="down">
						<img src="img/vote_down.gif"/>
					</button></li>
					<input type="hidden" value="'.$array[$i]->id.'" name="url_id" />
					</form>';
}
echo "</ol>";
//
//	This function retunrs an embed-friendly URL
//

function addEmbed($url) {
	$strToKeep = substr($url, -11);
	$embedString = "http://www.youtube.com/v/". $strToKeep;
	return $embedString;
}

?>
</body>
</html>

























