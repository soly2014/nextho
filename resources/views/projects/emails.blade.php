<form action="{{ route('send-email-post') }}" method="post" class="form-horizontal" data-parsley-validate>
    <div class="clearfix mb15">
        <div class="col-sm-12">
            <div class="table-responsive panel-collapse pull out thin-table" style="">
                <table class="table table-bordered table-hover responsive" id="Email_Templates_Table">
                    <thead>
                        <tr>
                            <th width="5%">Select</th>
                            <th width="35%">Template Name</th>
                            <th>Created By</th>
                            <th>Expiry Date</th>
                            <th>Sent #</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $today = date('y-m-d') ?>
                        <?php $first = true ?>
                        @foreach($emails as $email)
                        <?php 
                            $expired = false;
                            if($email->expiry_date < $today) $expired = true;
                        ?>
                        <tr>
                            <td class="text-center">
                                @if($expired)
                                <div class="radio custom-radio custom-radio-teal">
                                    <input type="radio" name="selected_template" <?php if($first){ ?> data-parsley-required <?php } ?> data-parsley-mincheck="1" data-parsley-error-message="You have to choose a Template to be able to Send." data-parsley-multiple="mymultiplelink" data-parsley-errors-container="#errors" id="{{ 'radio'.$email->id }}" value="{{ $email->id }}">
                                    <label for="{{ 'radio'.$email->id }}"></label>
                                </div>
                                @endif
                            </td>
                            <td><a href="{{ route('emails-view-single', array($email->id)) }}">{{ $email->template_name }}</a>
                                @if($email->marked_deleted)
                                - <span class="label label-danger" title="{{ 'Deleted by '.$email->userDeleted->username.' at '.$email->deleted_at }}">Deleted</span>
                                @endif
                                
                                @if(!$email->published)
                                 - <span class="label label-warning">Not Published</span>
                                @endif
                            </td>
                            <td>{{ $email->userCreated->username }}</td>
                            <td>{{ $email->expiry_date }}</td>
                            <td>{{ $email->sent_number }}</td>
                            <td>
                                @if(!$expired)
                                    <span class="label label-danger">Expired</span>
                                @else
                                    <span class="label label-success">Available</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="errors">
                    @if($errors->has('selected_template'))
                    <div class="help-block">{{ $errors->first('selected_template') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="bg-solid">
        <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-9">
                <div class="note note-primary">
                    <strong>Note!</strong> Any Email Template Sent from the CRM will be sent to your email "{{ Auth::user()->email }}".
                </div>
            </div>
        </div>
        {{ csrf_field() }}
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9">
                <button type="submit" class="btn btn-primary btn-sm"><i class="ico-mail-send mr5"></i>Send Email</button>
                <button type="reset" class="btn btn-danger btn-sm"><i class="ico-close2 mr5"></i>Reset</button>
            </div>
        </div>
    </div>
</form>