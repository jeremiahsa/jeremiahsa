$(document).ready(function() {

	// Gets all the videos from the RESTful API
	$.getJSON('https://ashapi.heroku.com/videos?jsoncallback=?', function(data) {
		var id = [];
		alert (id);
		$.each(id, function(key, val) {
			id.push('<li id="' + key + '">' + val + '</li>');
			
		});
		
		$('<ul/>', {
		    'class': 'my-new-list',
		    html: id.join('')
		  }).appendTo('#top-10-by-rating');
	});
	// GETS the first video from the RESTFUL API by ID
	$.getJSON('https://ashapi.heroku.com/videos/:id/?jsoncallback=?', function(data) {
		var data = [];
		alert (data);
	});


});


$('#submit').click(function() {
	alert ('you clicked submit');
	var formdata = $('form').serialize();	
	alert (formdata);
	$.ajax ({
		type: 'PUT',
		url: "https://ashapi.heroku.com/videos/:id",
		data:  formdata ,
		success:function(formdata) {
			alert('submitted');
		},
		error:function() {
			alert('an error occurred');
		}
	});





});