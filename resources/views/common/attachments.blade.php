<?php
    if($model_type == "Client"){
        $delete     = Auth::user()->userRole->delete_any_client_attachment;
        $restore    = Auth::user()->userRole->restore_any_client_attachment;
    } else if($model_type == "Campaign"){
        $delete     = Auth::user()->userRole->delete_any_campaign_attachment;
        $restore    = Auth::user()->userRole->restore_any_campaign_attachment;
    } else {
        $delete     = Auth::user()->userRole->delete_any_attachment;
        $restore    = Auth::user()->userRole->restore_any_attachment;
    }
$user = Auth::user()->id;
?>

<div class="clearfix mb15">
    <div class="col-sm-12">
        <div class="table-responsive panel-collapse pull out thin-table" style="">
            <table class="table table-bordered table-hover responsive" id="Attachments_Table">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Attached By</th>
                        <th>Uploaded Time</th>
                        <th>Size</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attachments as $attachment)
                    <tr>
                        <td>
                        
                            <a href="{{ route('attachment-download-post', array($attachment->id)) }}"><u>{{ $attachment->filename }}</u></a> 
                        @if($attachment->marked_deleted)
                             - <span class="ml5 label label-danger" title="{{ 'Deleted by '.$attachment->userDeleted->username.' at '.$attachment->deleted_at }}">Deleted</span>
                        @endif
                        </td>
                        <td>{{ $attachment->userAttached->username }}</td>
                        <td>{{ $attachment->created_at }}</td>
                        <td>{{ $attachment->size }}</td>
                        <td>
                        @if(($delete || ($user == $attachment->attached_by)))
                            @if($attachment->marked_deleted)
                                @if($restore)
                                    <a href="{{ route('attachment-restore', array($attachment->id)) }}" class="btn btn-primary btn-xs confirm-restore-first">Restore</a>
                                @endif
                            @else
                                <a href="{{ route('attachment-delete', array($attachment->id)) }}" class="btn btn-danger btn-xs warn-first">Delete</a>
                            @endif
                        @else
                            <a href="{{ route('attachment-download-post', array($attachment->id)) }}" class="btn btn-xs btn-primary">Download</a> 
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@if(isset($add_attachment) && $add_attachment)
<form class="form-horizontal" action="{{ route('attachment-create-post') }}" enctype="multipart/form-data" method="post" data-parsley-validate>
    <div class="bg-solid">
        <div class="form-group">
            <label class="col-sm-2 control-label">Attach File:</label>
            <div class="col-sm-9">
                <h3 class="thin-title">Select File</h3>
                <p class="info-block">Total File(s) size should not exceed <?php echo ini_get("upload_max_filesize"); ?>.</p>
                <input type="file" name="attachements[]" id="attachements" multiple data-parsley-required>
                <span class="checkbox custom-checkbox custom-checkbox-teal">
                    <input type="checkbox" name="fake_name" id="fake_name"/>
                    <label for="fake_name">&nbsp;&nbsp;Use Fake Name</label>
                </span>
                <input type="hidden" value="{{ $model_type }}" name="attachable_type">
                <input type="hidden" value="{{ $object->id }}" name="attachable_id">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9">
                <button type="submit" class="btn btn-primary btn-sm"><i class="ico-checkmark mr5"></i>Save</button>
                <button type="reset" class="btn btn-danger btn-sm"><i class="ico-close2 mr5"></i>Reset</button>
            </div>
        </div>
    </div>
    {{ csrf_field() }}
</form>
@endif