@foreach ($events as $event)
    <div id="delete_event_{!! $event->id !!}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Are you sure?</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete this event! This process cannot be undone.</p>
                    <p>Are you sure you wish to continue?</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" href="{!! URL::route('events.destroy', array('events' => $event->id)) !!}" data-token="{!! Session::getToken() !!}" data-method="DELETE">Yes</a>
                    <button class="btn btn-danger" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
