<div id="delete_event" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Are you sure?</h3>
    </div>
    <div class="modal-body">
        <p>Are you sure you want to delete this event?</p>
    </div>
    <div class="modal-footer">
        <a class="btn btn-success" href="{{ URL::route('events.destroy', array('events' => $event->getId())) }}" data-token="{{ Session::getToken() }}" data-method="DELETE">Yes</a>
        <button class="btn btn-danger" data-dismiss="modal">No</button>
    </div>
</div>
