<!-- Form Input for Text and Textarea-->
<div class="form-group">
    {!! Form::label($input['columnName'],$input['title'].' : ') !!}
    @if(isset($input['message']) && $input['message'] != '')
        <code>{!! $input['message'] !!}</code>
    @endif
    {!! Form::{$input['type']}($input['columnName'],null,['class' => 'form-control', 'data-id' => $input['columnName']]) !!}
</div>
