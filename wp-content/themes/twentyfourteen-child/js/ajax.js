jQuery(function($) {
	
		$('a').not('.site-title a').click(function(e){
			
			alert('clicked');
			
			e.preventDefault();
					
			var link = $(this).attr("href");
			
			$('#ajax-content').load(link);
			
		});
	
});