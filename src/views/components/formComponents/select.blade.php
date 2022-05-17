<!-- Form select -->
{!! Form::label($input['columnName'],$input['title'].' : ') !!}
@if(isset($input['message']) && $input['message'] != '')
    <code>{!! $input['message'] !!}</code>
@endif
<div class="form-group">
    <select class="form-control" name='{{$input['columnName']}}'>

        <option value="">
            {!! $input['title'] !!}
        </option>
        @foreach($input['arrayOfData'] as $innerData)
            @if (!empty($selectSelectedValue) || !empty(old($input['columnName'])))
                @if ($innerData['key'] ==old($input['columnName']) ||$innerData['key'] ==$selectSelectedValue)
                    <option {!! "selected" !!} value="{!! $innerData['key'] !!}">
                        {!! $innerData['value'] !!}
                    </option>

                @else
                    <option value="{!! $innerData['key'] !!}">
                        {!! $innerData['value'] !!}
                    </option>
                @endif
            @else
                <option value="{!! $innerData['key'] !!}">
                    {!! $innerData['value'] !!}
                </option>

            @endif
        @endforeach

    </select>
</div>
