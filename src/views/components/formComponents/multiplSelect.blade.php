<!-- Form select -->
{!! Form::label($input['columnName'],$input['title'].' : ') !!}
@if(isset($input['message']) && $input['message'] != '')
    <code>{!! $input['message'] !!}</code>
@endif
<div class="form-group">
    {{--    @dd($input['arrayOfData'])--}}

    <select class="form-control" name='{{$input['columnName']}}' multiple="multiple">

        <option value="">
            @if(isset($input['defaultOption']) && $input['defaultOption'] != '')
                {!! $input['defaultOption'] !!}
            @else
                {!! $input['title'] !!}
            @endif
        </option>

        @foreach($input['arrayOfData'] as $innerKey => $inner_value)
            @if (!empty($selected_value['input_value']) || !empty(old($input['columnName'])))
                @if ($inner_value['key'] == $selected_value['input_value'] && $selected_value['input_value'] != '')
                    <option
                        {!! "selected" !!} value="{!! $inner_value['key'] !!}">{!! $inner_value['value'] !!}
                    </option>
                @endif
            @else
                <option
                    value="{!! $inner_value['key'] !!}">{!! $inner_value['value'] !!}
                </option>
            @endif
        @endforeach
    </select>
</div>
