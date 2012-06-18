$(document).ready(function() {
	
//
// 		Show/Hide the top 10 section with the buttons 
//		Also handles the submission and injection of the top 10 results
//		Into the appropriate div upon click of the respective button
	
	$('#rating').hide();
	$('#views').hide();
	$('#submission').hide();
	

	
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
		return true;
	});
	
	$('#by-submission').click(function() {
		$('#rating').hide();
		$('#views').hide();
		$('#submission').fadeIn();	
		return true;
	});


});