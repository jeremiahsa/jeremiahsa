<!DOCTYPE html>
<head>
<title>Views</title>
</head>
<body>

<?php
echo "something";

if (isset($_GET['id'])) {
	$video_id = $_GET['id'];
	
	// if cookie is active, view will be ignored
	
	if (isset($_COOKIE[$video_id])) {
		echo "cookie is set";
		exit;
		
	} else {
	// set new cookie	
	$expire = time()+60*60*24;
	setcookie($video_id, $expire);
		
	}
}

?>
</body>
</html>