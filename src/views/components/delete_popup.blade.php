<!-- Delete Pop up Window -->
<div class="modal fade" id="delete" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete?</h4>
                <button type="button" class="close cancel_delete" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete the highlighted row?</h5>
                <input type="hidden" name="row_id" id="row_id" value=""/>
                <input type="hidden" name="path" id="path" value="{{ $path }}"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn delete_row btn-danger" data-dismiss="modal">Yes</button>
                <button type="button" class="btn cancel_delete btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

