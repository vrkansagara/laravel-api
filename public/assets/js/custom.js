(function ($) {
    'use strict';
    // loader
    setTimeout(function () {
        $(".page-loader-wrapper").fadeOut();
    }, 50);
    // Sidebar custom scroll
    $(".sidebar").slimScroll({
        height: 'calc(100vh - 70px)'
    });
    // Menu icon animation
    setTimeout(function () {
        $(".hamburger").removeClass("hamburger-on");
    }, 2000);
    //Initialize Select2 Elements
    $('.select2').select2({
        placeholder: "Select",
        allowClear: true
    });
    // Tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

})(jQuery)





var doAjaxParamsDefault = {
    'url': null,
    'requestType': "GET",
    'contentType': 'application/x-www-form-urlencoded; charset=UTF-8',
    'dataType': 'json',
    'data': {},
    'beforeSendCallbackFunction': null,
    'successCallbackFunction': null,
    'completeCallbackFunction': null,
    'errorCallBackFunction': null,
};

function doAjax(doAjaxParams) {
// Ref:- https://stackoverflow.com/questions/28689332/how-can-i-make-many-jquery-ajax-calls-look-pretty
    // $('.button').on('click', function() {
    //     var params = $.extend({}, doAjax_params_default);
    //     params['url'] = `your url`;
    //     params['data'] = `your data`;
    //     params['successCallbackFunction'] = `your success callback function`
    //     doAjax(params);
    // });

    var url = doAjaxParams['url'];
    var requestType = doAjaxParams['requestType'];
    var contentType = doAjaxParams['contentType'];
    var dataType = doAjaxParams['dataType'];
    var data = doAjaxParams['data'];
    var beforeSendCallbackFunction = doAjaxParams['beforeSendCallbackFunction'];
    var successCallbackFunction = doAjaxParams['successCallbackFunction'];
    var completeCallbackFunction = doAjaxParams['completeCallbackFunction'];
    var errorCallBackFunction = doAjaxParams['errorCallBackFunction'];

    //make sure that url ends with '/'
    /*if(!url.endsWith("/")){
     url = url + "/";
    }*/

    $.ajax({
        url: url,
        crossDomain: true,
        type: requestType,
        contentType: contentType,
        dataType: dataType,
        data: data,
        beforeSend: function (jqXHR, settings) {
            if (typeof beforeSendCallbackFunction === "function") {
                beforeSendCallbackFunction();
            }
        },
        success: function (data, textStatus, jqXHR) {
            if (typeof successCallbackFunction === "function") {
                successCallbackFunction(data);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (typeof errorCallBackFunction === "function") {
                errorCallBackFunction(errorThrown);
            }

        },
        complete: function (jqXHR, textStatus) {
            if (typeof completeCallbackFunction === "function") {
                completeCallbackFunction();
            }
        }
    });
}

$(function () {

    // Login for active and inactive tab.
    if (window.location.hash) {
        $('#nav-tab a[href="' + window.location.hash + '"]').trigger('click');
    } else {
        var activeTab = localStorage.getItem('activeTab');
        $('#nav-tab a[href="' + activeTab + '"]').trigger('click');
    }
    $('#nav-tab a').click(function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
        // document.getElementById("activeTab").value = window.location.hash;
        $(this).tab('show');
        var scrollmem = $('body').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
    });


});



var start = new Date();
var end = new Date(new Date().setYear(start.getFullYear() + 100));
$('#fromDate').datepicker({
    startDate: start,
    endDate: end,
    autoclose: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
}).on('changeDate', function() {
    $('#toDate').datepicker('setStartDate', new Date($(this).val()));
});
$('#toDate').datepicker({
    startDate: start,
    endDate: end,
    autoclose: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
}).on('changeDate', function() {
    $('#fromDate').datepicker('setEndDate', new Date($(this).val()));
});
