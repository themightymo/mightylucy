/**
 * Developer Hours JavaScript File for Datatables
 *
 */
( function( $ ) {
	

	$( function() {
		//var table = $('#myTable').DataTable();
						
		jQuery('#rangeFrom, #rangeTo').change( function() {
			if (jQuery('#rangeFrom').val() && jQuery('#rangeTo').val() ) {
				populate_developer_hours_table( );
			}
		} );
		
		jQuery('#rangeTo').trigger( 'change' );

	} );
	
	
	
	
} )( jQuery );



function populate_developer_hours_table(){
	destroyDatatable();
	devTable = jQuery("#dev_hours").dataTable( {
				"ajax": {
							url: front_end_ajax_identificator.ajaxurl,
						 	data: ({action : 'get_developers_hours', start_date: jQuery('#rangeFrom').val(), end_date: jQuery('#rangeTo').val() }),
						 	
							type: "GET"
						},
				"columns": [
					{ "title":"sitename" },
				    { "title":"hours" },
				    { "title":"date" },
				    { "title":"developer" },
				    { "title":"billable" },
				    { "title":"meta" }
				]
			} );   	
}

function destroyDatatable(){
	if(devTable)
	{
		devTable.fnDestroy();
	}
}

var devTable;