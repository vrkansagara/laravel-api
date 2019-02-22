// $('#userDataTable').on( 'error.dt', function ( e, settings, techNote, message ) {

//     console.log( 'An error has been reported by DataTables: ', message );
//     console.log( 'An error has been reported by DataTables: ', settings );
//     console.log( 'An error has been reported by DataTables: ', techNote );
// } ) ;
// $('#userDataTable').on( 'error', function ( e) {
//     $("#userDataTable").append(e);
// } ) ;
//
//
$(document).ready(function () {
    $.fn.dataTable.ext.errMode = 'none';
    $.fn.dataTable.ext.errMode = function (settings, tn, msg) {
        debugger;
        if (settings && settings.jqXHR && settings.jqXHR.status == 403) {
            // Handling for 401 specifically
            $("#" + settings.nTable.id).append("<b>This action is unauthorized.</b>");
        }
        // Handling for all other errors, this implements the DataTables default
        // behavior of throwing an alert

    };

});
