@extends('layouts.app')

@section('wrapper-class','animated fadeInRight')
@section('navbar-extra-class','white-bg')

@section('content')


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" id="myModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div data-id="1" data-ref="active"  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container modal-container">
                        <div id="json-data">
                            data would be here
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-primary loadMoreData">
                        Launch demo modal
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('after-script')
    <script>
        var modalSelector = '#exampleModal';
        $(modalSelector).on('show.bs.modal', function () {
            console.log("Event =====> show.bs.modal");
            $(modalSelector).find('#json-data').html(null);
            getUsers();
        });
        $(modalSelector).on('shown.bs.modal', function () {
            console.log("Event =====> shown.bs.modal");
        });
        $(modalSelector).on('hide.bs.modal', function () {
            console.log("Event =====> hide.bs.modal");
        });
        $(modalSelector).on('hidden.bs.modal', function (e) {
            console.log("Event =====> idden.bs.modal");
            $(this).data('id',1);
            $(this).data('ref','');
        });

       $('#myModal').on('click',function(){
           $(modalSelector).modal('show');
       });

       $('.loadMoreData').on('click',function () {

           getUsers();
       });

       function getUsers (){
           var modalSelector = '#exampleModal';

           nextPage =  $(modalSelector).data('id');
           userType =  $(modalSelector).data('ref');

           var params = $.extend({}, doAjaxParamsDefault);
           params['url'] = "{{route('user.get.list.modalbox')}}";
           params['requestType'] = 'post';
           params['dataType'] = 'json';
           params['data'] = {
               page: nextPage,
               status: userType
           };
           params['successCallbackFunction'] = function (data){
               var html = JSON.stringify(data.data) + '<br>';
               $(modalSelector).find('#json-data').append(html);
               $(modalSelector).data('id',nextPage +1 );
           };
           doAjax(params);
       }



    </script>
@endsection
