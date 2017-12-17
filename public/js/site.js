$(document).ready(function(){
	//because new a href was born so jquery dont know we need to use document on to check or static element
	//ok it's working, now you can try with this way to make pagination via ajax. i stop it now, see you in next video with CRUD
	$(document).on('click', '.pagination a', function(e) {
		e.preventDefault();
		e.stopPropagation();
		e.stopImmediatePropagation();
		var url = $(this).attr('href');
		$.ajax({
			url: url,
			method: 'GET',
			data: {},
			dataType: 'json',
			success: function(result) {
				if ( result.status == 'ok' ) {
					$('#taskListingGrid').html(result.listing);
				}
				else {
					alert("Error when get pagination");
				}
			}
		});
		return false;
	});
});