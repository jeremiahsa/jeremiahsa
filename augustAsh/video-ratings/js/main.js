$(document).ready(function() {


//
// 		Show/Hide the top 10 section with the buttons 
//		
	
	$('#rating').hide();
	$('#views').hide();
	$('#submission').hide();
	
//
//		Handles the submission and injection of the top 10 results
//		Into the appropriate div upon click of the respective button
//
	
	$('#by-rating').click(function() {
		$('#views').hide();
		$('#submission').hide();
		$('#rating').fadeIn();
		$.ajax({
				url:'top-10.php',
				method: 'POST',
				data: 'byratings=123',
				success: function(data) {
					$('#rating').empty();
					$('#rating').append(data);
				}
			}); // end ajax
			return false;
	});
	
	$('#by-views').click(function() {
		$('#views').fadeIn();	
		$('#rating').hide();
		$('#submission').hide();
		$.ajax({
				url:'top-10.php',
				method: 'POST',
				data: 'views=123',
				success: function(data) {
					$('#views').empty();
					$('#views').append(data);
				}
			}); // end ajax
		return false;
	});
	
	$('#by-submission').click(function() {
		$('#rating').hide();
		$('#views').hide();
		$('#submission').fadeIn();	
		$.ajax({
				url:'top-10.php',
				method: 'POST',
				data: 'submission=123',
				success: function(data) {
					$('#submission').empty();
					$('#submission').append(data);
				}
			}); // end ajax
		return false;
	}); // end by-submission

//
//		Handles the click of the <a href> tags inside the top 10 div
//		And updates the embed code for the video player.
//


});