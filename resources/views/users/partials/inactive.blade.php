@if(!$user->active)
<div class="col-md-12">

    <div class="alert alert-danger">
        <strong>Note, </strong> The selected user is curently inactive since {{ $user->deactivated_at }} - <a href="{{ route('users-reactivate', array($user->id)) }}"><b>Reactivate User</b></a>
    </div>

</div>
@endif