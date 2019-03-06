@extends('layouts.app')
@section('wrapper-class','animated fadeInRight')
@section('after-style')
    <link href="{{asset('assets/css/plugins/summernote/summernote-bs4.css')}}" rel="stylesheet">
@endsection


@section('content')

    <form action="{{route('sample.editor.post')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Editor</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content no-padding">

                        <div class="summernote">
                            <h1>Hello World</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">

                    <div class="ibox-content">

                        <h2>
                            Editor preview
                        </h2>
                        <hr>

                        <div id="editorPreview">
                        </div>
                        <input type="hidden" name="editor_data" id="editor_data">
                    </div>
                </div>
            </div>

        </div>


        <button type="submit" value="Submit" class="form-control">Submit</button>
    </form>

@endsection


@section('after-script')
    <script src="{{asset('assets/js/plugins/summernote/summernote-bs4.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                callbacks: {
                    onInit: function () {
                        $('#editorPreview').html($('.summernote').html())
                        $('#editor_data').val($('.summernote').html())
                    },
                    onChange: function (contents, $editable) {
                        console.log('onChange:', contents, $editable);
                        $('#editorPreview').html(contents)
                        $('#editor_data').val($('.summernote').html())
                    }
                }
            });
        });
    </script>
@endsection
