@extends('layouts.app')

@section('wrapper-class','animated fadeInRight')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center m-t-lg">
                <h1>
                    {{env('APP_NAME')}}
                </h1>
                <small>
                    This is dashboard
                </small>
            </div>
        </div>
    </div>
@endsection

