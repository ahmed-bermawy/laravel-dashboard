@extends('dashboard.admin_template')
@section('content')
@include('dashboard.components.orderStyle')
    <h4 class="float-left" style='margin:0 0 10px 0;'>Order List </h4>
    <div class="clear"></div>

    @if(count($data) == 0)
        <h2 style="" class="">No List to Order.</h2>
    @else
        {!! Form::open(['url' => $path.'saveOrder']) !!}

        <ul id="sortable" class="ui-sortable col-xs-4">
            @foreach ($data as $row)
                <li id="{{ $row->order_id}}" class="ui-state-default">
                    <input type="hidden" name="id[]" value="{{ $row->id }}">
                    <i class="fas fa-sort"></i>
                    <span>{{ $row->name  }}</span>
                </li>
            @endforeach
        </ul>
        <div class="clear"></div>
        <br>
        {{--<input type="hidden" name="foreign_key" value="{{ $foreign_key }}">--}}

        {!! Form::submit('Save Order List',['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    @endif

@endsection

@section('custoJs')
    <script>
        $(document).ready(function () {
            $("#sortable").sortable();
            $("#sortable").disableSelection();
        });
    </script>
@endsection
