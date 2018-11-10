@if(\Request::session()->get('success'))
<div class="col-md-12">
    
    <div class="alert alert-dismissable alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! \Request::session()->get('success') !!}
    </div>
    
</div>
@endif

@if(\Request::session()->get('error'))
<div class="col-md-12">
    
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! \Request::session()->get('error') !!}
    </div>
    
</div>
@endif

@if(\Request::session()->get('info'))
<div class="col-md-12">
    
    <div class="alert alert-dismissable alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! \Request::session()->get('info') !!}
    </div>
    
</div>
@endif

@if(\Request::session()->get('warn'))
<div class="col-md-12">
    
    <div class="alert alert-dismissable alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! \Request::session()->get('warn') !!}
    </div>
    
</div>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
