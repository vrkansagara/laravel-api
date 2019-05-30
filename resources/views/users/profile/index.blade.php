@extends('layouts.app')

@section('wrapper-class','animated fadeInRight')
@section('navbar-extra-class','white-bg')

@section('content')


    <div class="row m-b-lg m-t-lg">
        <div class="profile-image">
            <img src="{{$userImageUrl}}" class="rounded-circle circle-border m-b-md" alt="profile">
        </div>
        <div class="profile-info">
            <div class="">
                <div>
                    <h2 class="no-margins">
                        {{$user->name}}
                    </h2>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-lg-9">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Personal details</h3>

                    {{ Form::open(['route'=>['profile.update',$user->id],'method' => 'patch','files'=>true,'class'=>'m-t','id'=>'user-profile']) }}
                    <div class="form-group">
                        <label>Image</label>
                        {{Form::file('image',[])}}
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        {{Form::password('password',['class'=>"form-control",'placeholder'=>__('Password'),'title'=>__('Password')])}}
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        {{Form::password('confirm_password',['class'=>"form-control",'placeholder'=>__('Confirm Password'),'title'=>__('Confirm Password')])}}
                    </div>

                    <div class="form-group">
                        <span>This is image validatin</span>
                        <img src="sdfdsf" alt="image2" name="image2" id="image2">
                    </div>

                    {{ Form::button('Submit',['class'=>"btn btn-primary btn-block",'id'=>'submit']) }}

                    {{ Form::close() }}


                </div>
            </div>
        </div>


    </div>


@endsection

@section('after-script')
    <!-- Laravel Javascript Validation -->
    {!! $validator->selector('#user-profile') !!}

    <script>
        $( document ).ready(function() {
            $('#submit').on('click',function () {
console.log("i am clicked on submit");

                // if($('#image2').attr('src') == "" || $('#image2').attr('src') == undefined){
                event.preventDefault();
                // }
                var isVAlid = $('#user-profile').valid();

console.log("form is ",isVAlid)

            });
        });
    </script>
@endsection

