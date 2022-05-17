<!-- Form Input for password -->
<div class="form-group">
    {!! Form::label($input['columnName'],$input['title'].' : ') !!}
    @if(isset($input['message']) && $input['message'] != '')
        <code>{!! $input['message'] !!}</code>
    @endif
    {!! Form::{$input['type']}($input['columnName'],['class' => 'form-control','autocomplete'=>"on"]) !!}
    @if($input['columnName'] == 'confirm_password')
        <p id="confirm_password_error" class="field_error alert-danger" style="display: none;"> This field
            is required</p>
        <p id="not_match_error" class="field_error alert-danger" style="display: none;"> Password does not
            match</p>
    @endif
</div>
