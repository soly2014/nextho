@if($project->marked_deleted)
<div class="col-md-12">

    <div class="alert alert-danger">
        <strong>Note, </strong> The selected Project is curently Deleted since {{ $project->deleted_at }} - <a href="{{ route('projects-restore', array($project->id)) }}" class="confirm-first"><b>Restore Project</b></a>
    </div>

</div>
@endif