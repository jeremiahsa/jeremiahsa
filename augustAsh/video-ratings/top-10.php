<!DOCTYPE html>
<head>
<title>The top 10 videos</title>
<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript">
// Because the data is retrieved with AJAX, it is necessary to have the JS called from this page when dealing with this data.
// This section dynamically obtains the id number when a video is clicked

$(".viewdiv").click(function() {
	//get div id == video id
	
	var video_id = $(this).attr("id");

//		alert (video_id);
	
	$.ajax({
		url:'views.php',
		method:'POST',
		data: 'id='+video_id,
		success: function(data) {
			alert ("You have viewed the video");
		}
	}); // end ajax
	
})
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
//	Cache lists for up to 5 minutes to prevent server overload
//	

function cacheThisList($filename, $content) {
	if (file_exists($filename)) { 	//check if file exists
		$cacheTime = 300;
		if (time() - $cacheTime > filemtime($filename)) {	// if file has not expired, serve file from cache
			writeFromCache($filename);
		} else {	// if cache file is expired, write new cache file
			writeNewCacheFile($filename, $content);
		} 
	}	else {		// if file does not exist, write new cache file
			writeNewCacheFile($filename, $content);
	}
	
}

//	This function is invoked to refresh the cache file if necessary.

function writeNewCacheFile($filename, $content) {
	$fp = fopen($filename, 'w');
	fwrite($fp, $content);
	fclose($fp);
	writeFromCache($filename);
}

//	This function is invoked to serve the cache file when called.

function writeFromCache($filename) {
	$fh = fopen($filename, 'r');
	$fileContents = fread($fh, filesize($filename));
	echo $fileContents;
	fclose($fh);
}
	
	
	
//
//	Get top 10 videos by Views
//

if ($_GET['views'] != NULL) {
	echo '<h2>By Views</h2>';
	$ashuri = 'https://ashapi.heroku.com/videos/top10/views';
	$filename = "cache/views.txt";
	
}

//
//	Get top 10 videos by Submission
//

else if ($_GET['submission'] != NULL) {
	echo '<h2>By Submission</h2>';
	$ashuri = 'https://ashapi.heroku.com/videos';
	$filename = "cache/submission.txt";
}

//
//	Get top 10 videos by Rating
//

else if ($_GET['byratings'] != NULL) {
	echo '<h2>By Ratings</h2>';
	$ashuri = 'https://ashapi.heroku.com/videos/top10/votes';
	$filename = "cache/ratings.txt";
	
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

$content = "";
ob_start();
for ($i=1; $i<=10; $i++) {
	$urlForEmbed = addEmbed($array[$i]->url);
	
	$content .= "<li><h3>". $array[$i]->title . "</h3>".
	 		// allow js to govern links 
			"<div class=\"viewdiv\" id=\"".$array[$i]->id."\"><embed width=\"250\" height=\"250\" src=\"".$urlForEmbed."\" type=\"application/x-shockwave-flash\"><br>" . 
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
ob_end_flush();
cacheThisList($filename, $content);

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

























