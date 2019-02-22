@extends('layouts.auth')

@section('content')

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Welcome to {{env('APP_SHORT_NAME')}}</h2>

                <p>
                    Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app
                    views.
                </p>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s.
                </p>

                <p>
                    When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <p>
                    <small>It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged.
                    </small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    {{ Form::open(['route'=>'login','method'=>'POST','class'=>'m-t']) }}
                    @csrf
                    <div class="form-group">
                        {{Form::email('email', old('email') ,['class'=>"form-control",'placeholder'=>__('E-Mail Address'),'title'=>__('E-Mail Address'),'required autofocus'])}}
                    </div>
                    <div class="form-group">
                        {{Form::password('password',['class'=>"form-control",'placeholder'=>__('Password'),'title'=>__('Password'),'required'])}}
                    </div>


                    <div class="form-group">
                        <input class="form-check-input" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>



                    <button type="submit" class="btn btn-primary block full-width m-b">{{ __('Login') }}</button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                    <p class="text-muted text-center">
                        <small>Do not have an account?</small>
                    </p>
                    <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Create an account</a>
                    {{Form::close()}}
                </div>
            </div>
        </div>
        <hr/>
        {!! env('APP_COPYRIGHT') !!}
    </div>
@endsection


