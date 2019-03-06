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
    if($.fn.dataTable != undefined){
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
    }

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
    'crossDomain': true,
    'beforeSendCallbackFunction': null,
    'successCallbackFunction': null,
    'completeCallbackFunction': null,
    'errorCallBackFunction': null,
    'pageLength': 10,
    'responsive': true,
    'paging': true,
    'lengthChange': true,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': true,
    'columns': null,
    'searchDelay': 500,
    'columnDefs': '',
    // 'dom': '<"html5buttons"B>lTfgitp',
    'order': [[0, "ASC"]],
    'buttons': [
        {extend: 'copy',},
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
    var columnDefs = dataTableParams['columnDefs'];
    var info = dataTableParams['info'];
    var autoWidth = dataTableParams['autoWidth'];
    var searching = dataTableParams['searching'];
    var paging = dataTableParams['paging'];
    var lengthChange = dataTableParams['lengthChange'];
    var ordering = dataTableParams['ordering'];
    var buttons = dataTableParams['buttons'];
    var dom = dataTableParams['dom'];
    var order = dataTableParams['order'];


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
        order:order,
        responsive: responsive,
        buttons: buttons,
        searchDelay: searchDelay,
        columnDefs: columnDefs,
        searching: searching,
        paging: paging,
        lengthChange: lengthChange,
        ordering: ordering,
        info: info,
        autoWidth: autoWidth,
        language: {
            emptyTable: "No data available",
            loadingRecords: '&nbsp;',
            processing: '<div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"><div class="sk-bounce3"></div></div></div>'
        }

    });

    return thisObject;
};
