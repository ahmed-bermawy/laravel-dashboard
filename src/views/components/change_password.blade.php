<!-- Modal -->
<div class="modal fade" id="popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>
                    Change Password ?
                </h5>
                <button id="btn-close" type="button" class="btn-close" data-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="row_id" id="row_id" value=""/>
                <h6 class="modal-title" id="exampleModalLabel">You are about to change password for email :
                    <strong id="email"></strong>
                </h6>
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
                <p id="password_error" class="field_error alert-danger"> This field is required</p>

                {!! Form::label('confirm_password', 'Confirm Password') !!}
                {!! Form::password('confirm_password', ['class' => 'form-control']) !!}
                <p id="confirm_password_error" class="field_error alert-danger"> This field is required</p>


            </div>
            <div class="modal-footer">
                <p id="not_match_error" class="field_error alert-danger"> Password not matched</p>

                <p id="success" class="alert-success"></p>
                <p id="fail" class="alert-danger"></p>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submit_change_password">Save changes</button>
            </div>
        </div>
    </div>
</div>
