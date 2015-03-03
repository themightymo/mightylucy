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
				],
				"footerCallback": function ( row, data, start, end, display ) {
					var api = this.api(), data;
		 
					// Remove the formatting to get integer data for summation
					var intVal = function ( i ) {
						return typeof i === 'string' ?
							i.replace(/[\$,]/g, '')*1 :
							typeof i === 'number' ?
								i : 0;
					};
		 
					
		 
					// Total over this page
					pageTotal = api
						.column( 1, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
		 
					// Update footer
					jQuery( api.column( 1 ).footer() ).html(
						'Hours Invested: '+pageTotal 
					);
				}
			} );   	
}

function destroyDatatable(){
	if(devTable)
	{
		devTable.fnDestroy();
	}
}

var devTable;