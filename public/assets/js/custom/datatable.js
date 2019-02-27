

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

var dataTableManager = function () {

    //Private Variable
    var _self = this,
        _setTimeOut = 10000,
        _tableSelector = null
    ;

    //Public Variable
    this.timeout = _setTimeOut;

    //Private Methods
    _activate = function () {
    };

    _setTimeOut = function (timeOut) {
        if (timeOut) {
            _setTimeOut = timeOut;
        }
    };

    _setParams = function(params){

    };

    _deactivate = function () {
    };


    //Public Methods
    this.activate = _activate;
    this.deactivate = _deactivate;
    this.setTimeOut = _setTimeOut;
    this.setParams = _setParams;

    //Event Binding

    //Init
    this.init = function () {}
};
