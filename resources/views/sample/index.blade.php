@extends('layouts.app')

@section('after-style')
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker3.min.css')}}">
@endsection
@section('content')



<span>Ref:- https://uxsolutions.github.io/bootstrap-datepicker/?markup=input&format=&weekStart=&startDate=&endDate=&startView=0&minViewMode=0&maxViewMode=4&todayBtn=false&clearBtn=false&language=en&orientation=auto&multidate=&multidateSeparator=&keyboardNavigation=on&forceParse=on#sandbox</span>

    {{--<div class="container">--}}
    {{--{{ Form::open(['route' => 'sample.submit','method'=>'post','id'=>'my-form','class'=>"form-horizontal",'role'=>"form" ]) }}--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-10 col-md-offset-1">--}}
    {{--<div class="form-group">--}}
    {{--<label class="col-md-4 control-label">Name</label>--}}
    {{--<div class="col-md-6">--}}
    {{--{{ Form::text('name','This is my name',['class'=>'form-controll']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<label class="col-md-4 control-label">Email</label>--}}
    {{--<div class="col-md-6">--}}
    {{--{{ Form::email('email','test@gmail.com',['class'=>'form-controll']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<label class="col-md-4 control-label">Password</label>--}}
    {{--<div class="col-md-6">--}}
    {{--{{ Form::password('password',['class'=>'form-controll']) }}--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--{{ Form::submit('Submit',['class'=>'form-controll']) }}--}}
    {{--{{ Form::close() }}--}}
    {{--</div>--}}




    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {{ Form::open(['route' => 'sample.submit','method'=>'post','id'=>'my-form']) }}


                <div class="form-group">
                    {{--<label class="col-md-4 control-label">Start Date</label>--}}
                    <div class="col-md-6">
                        <input type="text" class="form-control datepicker" name="start_date">
                    </div>
                </div>

                <div class="form-group">
                    {{--<label class="col-md-4 control-label">End Date</label>--}}
                    <div class="col-md-6">
                        <input type="text" class="form-control datepicker" name="end_date">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Title</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Body</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Body</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label">End Date</label>
                    <div class="col-md-6">
                        <select name="countries" class="form-control select2" multiple>
                            <option> -- SELECT --</option>
                            <option value="1">1</option>
                            <option value="1">1</option>
                            <option value="1">1</option>
                            <option value="1">1</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                </div>

                {{ Form::submit('Submit',['class'=>'form-controll']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>



@endsection


@section('after-script')

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            $('.datepicker').datepicker({
                format: "dd/mm/yyy",
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true
            });

        });
    </script>
    {!! $validator->selector('#my-form') !!}
    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
@endsection
