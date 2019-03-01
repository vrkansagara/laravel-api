@extends('layouts.app')

@section('content')

    <div class="ibox ">
        <div class="ibox-title">
            <h5>User edit</h5>
        </div>
        <div class="ibox-content">
            {{Form::model($user,['route'=> ['users.update',$user->id],'method' => 'patch','id'=>'userProfile'])}}
                <div class="form-group row">
                    {{ Form::label('email','Email',['class'=>"col-lg-2 col-form-label"]) }}
                    <div class="col-lg-10">
                        {{ Form::email('email',$user->email, ['placeholder'=>'Email','class'=>'form-control','disabled']) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('name','Name',['class'=>"col-lg-2 col-form-label"]) }}
                    <div class="col-lg-10">
                        {{ Form::text('name',$user->name, ['placeholder'=>'Name','class'=>'form-control']) }}
                    </div>
                </div>
            <div class="form-group row">
                <div class="col-lg-2"></div>
                <div class="col-lg-10">
                    <button class="btn btn-primary btn-sm" type="submit">Update</button>
                    <button class="btn btn-white btn-sm" type="reset">Reset</button>
                    <a href="{{route('users.index')}}" class="btn btn-white btn-sm">Cancle</a>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
@endsection


@section('after-script')
{{ $validator->selector('#user-profile') }}
@endsection



