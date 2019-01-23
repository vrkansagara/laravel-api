String.prototype.endsWith = function (suffix) {
    return this.indexOf(suffix, this.length - suffix.length) !== -1;
};

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

    /**
     * Ref:- https://stackoverflow.com/questions/28689332/how-can-i-make-many-jquery-ajax-calls-look-pretty
     var doAjaxParamsDefault = {
         var params = $.extend({}, doAjaxParams_default);
            params['url'] = `your url`;
            params['data'] = `your data`;
            params['successCallbackFunction'] = `your success callback function`
            doAjax(params);
     */
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
