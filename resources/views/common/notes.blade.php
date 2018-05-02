<div class="clearfix notesContainer mb15">
    <?php 
        $modify     = Auth::user()->userRole->modify_any_note;
        $delete     = Auth::user()->userRole->delete_any_note;
        $restore    = Auth::user()->userRole->restore_any_note;
    ?>
    @foreach($notes as $note)
    <div class="col-sm-12 single-note-container">
        <div class="single-note-wrapper clearfix" data-note-id="{{ $note->id }}" data-actionType="{{ $note->activity_type }}" >
            <div class="col-sm-9">
                <p class="single-note">{{ $note->note_text }}</p>
                <div class="note-author">
                    <p class="text-muted"><b>Author</b> - {{ $note->userCreated->username }}, <b>Created at</b> - {{ $note->created_at }} 
                        @if($note->marked_deleted)
                            - <span class="label label-danger" title="{{ 'Deleted by '.$note->userDeleted->username }}">Deleted</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="note-info">
                    <div class="note-options">
                        @if($modify || $delete)
                        <b>Actions</b>
                        @endif
                        <br />
                        @if($modify)
                        <a href="#" class="note-edit"><i class="ico-pencil7 mr5"></i>Edit</a>  
                        @endif
                        @if($delete)
                            @if($note->marked_deleted)
                                @if($restore)
                                <b> - </b><a href="{{ route('note-restore', array($note->id)) }}" class="text-primary confirm-restore-first"><i class="ico-loop2 mr5"></i>Restore</a>
                                @endif
                            @else
                                <b> - </b><a href="{{ route('note-delete', array($note->id)) }}" class="text-danger warn-first"><i class="ico-trash mr5"></i>Delete</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@if(isset($add_note) && $add_note)
<form action="{{ route('notes-create-post', array($object->id)) }}" method="post" class="form-horizontal" data-parsley-validate>
    <div class="bg-solid">
        @if($errors->has('note_text'))
        <div class="form-group has-error">
        @else
        <div class="form-group">
        @endif
            <label class="col-sm-2 control-label" for="note_text">Description:</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="4" cols="5" name="note_text" id="note_text" data-parsley-required>{{ e(old('note_text')) }}</textarea>
                @if($errors->has('note_text'))
                <div class="help-block">{{ $errors->first('note_text') }}</div>
                @endif
            </div><br>

            <div class="col-sm-9">
                @if($errors->has('activity_type'))
                <div class="form-group has-error" style="margin-top: 14px;">
                @else
                <div class="form-group" style="margin-top: 14px;">
                @endif
                    <label class="col-sm-3 control-label">Activity Type:</label>
                    <div class="col-sm-4">
                        <select class="form-control input-sm activity_type" name="activity_type" id="activity_type" data-parsley-required>
                            <option></option>
                            <option value="3">Call</option>
                            <option value="4">Meeting</option>
                        </select>
                        @if($errors->has('activity_type'))
                        <div class="help-block">{{ $errors->first('activity_type') }}</div>
                        @endif
                    </div>
                </div>
          </div>  

            <input type="hidden" value="{{ $model_type }}" name="noteable_type">
            <input type="hidden" value="{{ $object->id }}" name="noteable_id">
            <input type="hidden" value="0" name="current_note_id" id="current_note_id">
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9">
                <button type="submit" class="btn btn-primary btn-sm" ><i class="ico-checkmark mr5"></i>Save</button>
                <button type="reset" class="btn btn-danger btn-sm" id="notes-reset"><i class="ico-close2 mr5"></i>Reset</button>
            </div>
        </div>
    </div>
    {{ csrf_field() }}
</form>
@endif