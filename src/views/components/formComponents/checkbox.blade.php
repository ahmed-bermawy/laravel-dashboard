<!-- Form Input for checkbox -->
<div class="form-group d-inline-block m-3">
    {!! Form::label($input['columnName'],$input['title']) !!}
    @if(isset($input['message']) && $input['message'] != '')
        <code>{!! $input['message'] !!}</code>
    @endif
    @if(isset($checked) && isset($input['data-toggle']))
        {!! Form::{$input['type']}($input['columnName'],$input['value'], $checked,['data-toggle'=>$input['data-toggle'],'id'=>$input['id']]) !!}
    @elseif(isset($checked))
        {!! Form::{$input['type']}($input['columnName'],$input['value'], $checked) !!}
    @else
        {!! Form::{$input['type']}($input['columnName'],$input['value']) !!}
    @endif
</div>
