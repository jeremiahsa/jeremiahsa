$(document).ready(function() {
	
//
// 		Show/Hide the top 10 section with the buttons 
//		Also handles the submission and injection of the top 10 results
//		Into the appropriate div upon click of the respective button
//
	
	$('#rating').hide();
	$('#views').hide();
	$('#submission').hide();
	
	$('#by-rating').click(function() {
		$('#views').hide();
		$('#submission').hide();
		$.post('top-10.php', function(data) {
			window.location = 'top-10.php';
			$('#rating').fadeIn(data);
		});
		return false;
	});
	
	$('#by-views').click(function() {
		$('#views').fadeIn();	
		$('#rating').hide();
		$('#submission').hide();
		return false;
	});
	
	$('#by-submission').click(function() {
		$('#rating').hide();
		$('#views').hide();
		$('#submission').fadeIn();	
		return false;
	});


});