@extends('dashboard.admin_template')
@section('content')

    @include('dashboard.errors.list')

    {!! Form::open(['url' =>  preg_replace('/create/','/',$path),'files' => true ]) !!}

    @include('dashboard.roles._form',['formAction'=>'create','submitButtonText'=>'Add '.$pageName])

    {!! Form::close() !!}

@endsection
