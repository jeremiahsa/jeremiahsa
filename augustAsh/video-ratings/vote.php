<?php

//
// This is designed to vote the ratings of a particular video link up or down. 
//

//
//	Rules: 	1 vote per video (url) per person (cookie) day (time)
//
//
//			No voting on weekends (time)
//

notAWeekend(date("l", time()));

function notAWeekend($day_of_week) {
	if ($day_of_week === "Saturday" || $day_of_week === "Sunday") {
		echo $day_of_week. " is a Weekend. You may not vote again until Monday.";
	} else {
		processForm();
	}
}

function bakeACookie() {
	$expire = time()+60*60*24;
	setcookie('oneDayLimit' ,$expire);
}

function checkACookie() {
	if (isset($_COOKIE['oneDayLimit'])) {
		echo "You have already voted today. Please come again tomorrow";
		exit;
	}
}

function processForm() {
	if (isset($_POST['up'])) {
		checkACookie();
		bakeACookie();
		echo "You voted up: ".$url_id = $_POST["url_id"];
		vote($url_id, 1);
		
	} else if (isset($_POST['down'])) {
		checkACookie();
		bakeACookie();
		echo "You voted down: ".$url_id = $_POST["url_id"];
		vote($url_id, -1);
		
	} else {

		//form was not submitted, page was visited without submitting a form.

		echo "Please try submitting data to this page.";

	}
}

function vote($url_id, $opinion) {
	
	$ashuri = 'https://ashapi.heroku.com/videos/'.$url_id.'/votes';
	$ch = curl_init($ashuri);
	curl_setopt($ch, CURLOPT_USERPWD, "jsandahl:d598d6e400fb796ab23e39288bfd63d0");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, POST);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "id=$url_id&opinion=$opinion");
	$response = curl_exec($ch);
	
}

?>













