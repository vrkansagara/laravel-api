@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>User details</h5>
                </div>
                <div class="ibox-content">
                    <form method="get">

                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Name</label>

                            <div class="col-sm-10"><input type="text" value="{{$user->name}}" class="form-control" disabled=""></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row"><label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10"><input type="email" value="{{$user->email}}" class="form-control" disabled="">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{route('users.index')}}" class="btn btn-white btn-sm" >Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">

                <div class="ibox-content">

                    <h2>
                        Summernote
                    </h2>
                    <p>
                        Super Simple WYSIWYG Editor on Bootstrap
                    </p>

                    <div class="alert alert-warning">
                        Full documentation for Summernote.js, including examples and API calls, keybored shortcuts, PHP Examples, Django installation, and Rails (gem) integration can be found at:
                        <a href="http://summernote.org/deep-dive/">http://summernote.org/deep-dive/</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('after-script')

@endsection
