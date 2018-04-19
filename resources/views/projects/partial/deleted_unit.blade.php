@if($unit->marked_deleted)
<div class="col-md-12">

    <div class="alert alert-danger">
        <strong>Note, </strong> The selected Project Unit is curently Deleted by {{ $unit->userDeleted->username }} - <a href="{{ route('project-unit-restore', array($unit->id)) }}" class="confirm-first"><b>Restore Unit</b></a>
    </div>

</div>
@endif