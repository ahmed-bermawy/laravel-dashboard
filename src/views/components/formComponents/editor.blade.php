<!-- Form Input for Editor -->
<div class="form-group">
    {!! Form::label($input['columnName'],$input['title'].' : ') !!}
    @if(isset($input['message']) && $input['message'] != '')
        <code>{!! $input['message'] !!}</code>
    @endif
    {!! Form::textarea($input['columnName'],null,['class' => 'form-control', 'id' => 'editor', 'data-id' => $input['columnName']]) !!}
</div>
