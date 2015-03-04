/**
 * Developer Hours JavaScript File for Datatables
 *
 */
( function( $ ) {
	
	$.fn.dataTable.ext.search.push(
	    function( settings, data, dataIndex ) {
		    var from = $('#rangeFrom').val();
		    var rmin = from.substr(0,4)+from.substr(5,2)+from.substr(8,2)+'';
	
		    var rto = $('#rangeTo').val();
		    var rmax = rto.substr(0,4)+rto.substr(5,2)+rto.substr(8,2)+'';

	        var min = parseInt( rmin, 10 );
	        var max = parseInt( rmax, 10 );
	        var age = parseFloat( data[2] ) || 0; // use data for the age column
	 
	        if ( ( isNaN( min ) && isNaN( max ) ) ||
	             ( isNaN( min ) && age <= max ) ||
	             ( min <= age   && isNaN( max ) ) ||
	             ( min <= age   && age <= max ) )
	        {
	            return true;
	        }
	        return false;
	    }
	);

	$( function() {
		var table = $('#myTable').DataTable();
						
		$('#rangeFrom, #rangeTo').change( function() {
			table.draw();
		} );
		
		$('#rangeTo').trigger( 'change' );

	} );
	
} )( jQuery );