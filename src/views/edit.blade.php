@extends('dashboard.admin_template')
@section('content')

    @include('dashboard.errors.list')

{{--    @dd($data)--}}
    {!! Form::model($data,['method'=>'PUT','files' => true,'url' => url($path.$data->$tablePk  ?? '')]) !!}

    @include('dashboard._form',['formAction'=>'update','submitButtonText'=>'Update '.$pageName])

    {!! Form::close() !!}
@endsection
@section('custoJs')

    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            if (typeof CKEDITOR !== 'undefined') {
                CKEDITOR.replace('editor');
            }
        });
    </script>
@endsection

@if(session('message'))
    @include('dashboard.components.message_popup')
@endif
