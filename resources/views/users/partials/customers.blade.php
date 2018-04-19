<div class="table-responsive panel-collapse pull out" style="">
    <table class="table table-bordered table-hover responsive datatable" id="Customers_Table">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Company</th>
                <th>Number of Sold Units</th>
                <th>Sales Volume</th>
                <th>Became Customer</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $client)
            <tr>
                <td><a href="{{ route('customers-view-single', array($client->id)) }}">{{ $client->name }}</a></td>
                <td>{{ $client->company }}</td>
                <td>{{ $client->propertiesCount }}</td>
                <td>{{ number_format($client->propertiesAmount, 0) }} EGP</td>
                <td>{{ $client->customer_date }}</td>
                <td width="10%">
                    <div class="toolbar">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Action</button>
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{ route('leads-modify-single', array($client->id)) }}"><i class="icon ico-pencil"></i>Edit</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route('customers-view-single', array($client->id)) }}"><i class="icon ico-print3"></i>View</a></li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th><input type="search" class="form-control" name="search_engine" placeholder="Customer Name"></th>
                <th><input type="search" class="form-control" name="search_engine" placeholder="Company"></th>
                <th><input type="search" class="form-control" name="search_engine" placeholder="Number of Sold Units"></th>
                <th><input type="search" class="form-control" name="search_engine" placeholder="Sales Volume"></th> 
                <th><input type="search" class="form-control" name="search_engine" placeholder="Became Customer"></th> 
                <th width="10%"></th>
            </tr>
        </tfoot>
    </table>
</div>