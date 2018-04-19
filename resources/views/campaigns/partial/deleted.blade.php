@if($campaign->marked_deleted)
<div class="col-md-12">

    <div class="alert alert-danger">
        <strong>Note, </strong> The selected Campaign is curently Deleted since {{ $campaign->deleted_at }} - <a href="{{ route('campaigns-restore', array($campaign->id)) }}" class="confirm-first"><b>Restore Campaign</b></a>
    </div>

</div>
@endif