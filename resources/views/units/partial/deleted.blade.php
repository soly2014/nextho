@if($unit->marked_deleted)
<div class="col-md-12">

    <div class="alert alert-danger">
        <strong>Note, </strong> The selected Unit is curently Deleted since {{ $unit->deleted_at }} - <a href="{{ route('units-restore', array($unit->id)) }}" class="confirm-first"><b>Restore Unit</b></a>
    </div>

</div>
@endif