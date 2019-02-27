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
        // debugger;
        if (settings && settings.jqXHR && settings.jqXHR.status == 403) {
            // Handling for 401 specifically
            // $("#" + settings.nTable.id).append("<b>This action is unauthorized.</b>");
        }
        // Handling for all other errors, this implements the DataTables default
        // behavior of throwing an alert

    };

});

var dataTableParams_default = {
    'serverSide': true,
    'processing': true,
    'tableSelector': '',
    'url': null,
    'requestType': "GET",
    'dataType': 'json',
    'contentType': 'application/x-www-form-urlencoded; charset=UTF-8',
    'data': {},
    'crossDomain': false,
    'beforeSendCallbackFunction': null,
    'successCallbackFunction': null,
    'completeCallbackFunction': null,
    'errorCallBackFunction': null,
    'pageLength': 5,
    'responsive': true,
    'columns': null,
    'searchDelay': 500,
};

var dataTable = function (dataTableParams) {

    // Table related params
    var processing = dataTableParams['processing'];
    var serverSide = dataTableParams['serverSide'];
    var tableSelector = dataTableParams['tableSelector'];
    var pageLength = dataTableParams['pageLength'];
    var responsive = dataTableParams['responsive'];
    var columns = dataTableParams['columns'];

    // AJAX related params
    var url = dataTableParams['url'];
    var requestType = dataTableParams['requestType'];
    var data = dataTableParams['data'];
    var dataType = dataTableParams['dataType'];
    var crossDomain = dataTableParams['crossDomain'];
    var contentType = dataTableParams['contentType'];
    var searchDelay = dataTableParams['searchDelay'];


    var beforeSendCallbackFunction = dataTableParams['beforeSendCallbackFunction'];
    var successCallbackFunction = dataTableParams['successCallbackFunction'];
    var completeCallbackFunction = dataTableParams['completeCallbackFunction'];
    var errorCallBackFunction = dataTableParams['errorCallBackFunction'];

    var thisObject = $(tableSelector).DataTable({
        processing: processing,
        serverSide: serverSide,
        ajax: {
            url: url,
            crossDomain: crossDomain,
            type: requestType,
            contentType: contentType,
            dataType: dataType,
            data: data,
            // beforeSend: function (jqXHR, settings) {
            //     if (typeof beforeSendCallbackFunction === "function") {
            //         beforeSendCallbackFunction();
            //     }
            // },
            // success: function (data, textStatus, jqXHR) {
            //     if (typeof successCallbackFunction === "function") {
            //         successCallbackFunction(data);
            //     }
            // },
            // error: function (jqXHR, textStatus, errorThrown) {
            //     if (typeof errorCallBackFunction === "function") {
            //         errorCallBackFunction(errorThrown);
            //     }
            //
            // },
            // complete: function (jqXHR, textStatus) {
            //     if (typeof completeCallbackFunction === "function") {
            //         completeCallbackFunction();
            //     }
            // }
        },
        error: function (reason) {
            console.log("Error occurred !", reason);
            // parse "reason" here and take appropriate action
            $(tableSelector).append(reason);
        },
        failure: function () {
            $(tableSelector).append(" Error when fetching data please contact administrator");
        },
        columns: columns,
        pageLength: pageLength,
        // order: [[4, "desc"]],
        responsive: responsive,
        dom: '<"html5buttons"B>lTfgitp',
        // dom: 'lBfrtip',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'ExampleFile'},
            {extend: 'pdf', title: 'ExampleFile'},

            {
                extend: 'print',
                customize: function (win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ],
        searchDelay:searchDelay,
        language: {
            emptyTable: "No data available",
            loadingRecords: '&nbsp;',
            processing: '<div class="fa fa-spinner" > </div>'
        }

    });

    return thisObject;
};
