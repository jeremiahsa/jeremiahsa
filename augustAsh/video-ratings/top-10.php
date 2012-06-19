<!DOCTYPE html>
<head>
<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript">
$(function() {
    $("a").click(function() {
        return someMethodName($(this).attr('href'));
    });

	function someMethodName(href)
	{	
		$("#embedurl").attr('src', $(this).attr('href'));
	    console.log(href);
	    return false;
	}
});
</script>
</head>
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

for ($i=1; $i<=10; $i++) {
	echo  	"<h3>". $array[$i]->title . "</h3>".
	 		// allow js to govern links 
			"<a class=\"toembed\" href=\"".$array[$i]->url."\">" . 
			$array[$i]->url . "</a><br>" .
			$array[$i]->slug .
			": (".$array[$i]->vote_tally . ") votes" .
			" / (".$array[$i]->view_count . ") views";
}

?>
</html>

























