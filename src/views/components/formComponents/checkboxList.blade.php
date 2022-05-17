<!-- Form Input for checkbox -->
<div class="form-group">
    {!! Form::label($input['columnName'],$input['title'].' : ') !!}
    @if(isset($input['message']) && $input['message'] != '')
        <code>{!! $input['message'] !!}</code>
    @endif
    <br>
{{--    @dd($checkboxListSelectedValue)--}}
    @foreach($input['arrayOfData'] as $innerKey => $innerValue)
        @if(!empty($checkboxListSelectedValue))
            <input type="checkbox" name="{{$input['columnName']}}[]"
                   {{in_array($innerValue['key'],$checkboxListSelectedValue)? 'checked':''}}
                   value="{!! $innerValue['key'] !!}"> {!! $innerValue['value'] !!}<br>
        @else
            <input type="checkbox" name="{{$input['columnName']}}[]"
                   value="{!! $innerValue['key'] !!}"> {!! $innerValue['value'] !!}<br>
        @endif
    @endforeach

</div>
