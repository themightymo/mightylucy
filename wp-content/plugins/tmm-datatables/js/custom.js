jQuery(document).ready(function($) {
	
    var table = $('#myTable').DataTable( {
    
    	//via http://www.datatables.net/examples/advanced_init/footer_callback.html
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
            data = api.column( 1, { page: 'current'} ).data();
            pageTotal = data.length ?
                data.reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                } ) :
                0;
 
            // Update footer
            $( api.column( 1 ).footer() ).html(
                'Hours Displayed Above: '+pageTotal
            );
        },
        "iDisplayLength": 50
        
    } );
    	
});