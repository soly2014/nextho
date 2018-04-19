<div class="clearfix mb15">
    <div class="col-sm-12">
        <div class="table-responsive panel-collapse pull out thin-table collapse in" id="closed-activities">
            <table class="table table-bordered table-hover responsive" id="Closed_Activities_Table">
                <thead>
                    <tr>
                        <th>Propertey Name</th>
                        <th>Propertey Type</th>
                        <th>Amount</th>
                        <th>Sold By</th>
                        <th>Sold Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($properties as $property)
                    <tr>
                        @if($property->propertable_type == "Unit")
                        <td><a href="{{ route('units-view-single', array($property->Unit->id)) }}">{{ $property->Unit->property_id }}</a>
                        </td>
                        @else
                        <td><a href="#">{{ $property->Project ? $property->Project->name : '' }}</a>
                        </td>
                        @endif @if($property->propertable_type == "Unit")
                        <td>{{ $property->Unit->Type->label }}</td>
                        @else
                        <td>{{ $property->saleInfo->Type->label }}</td>
                        @endif 
                        <td>{{ number_format($property->price, 0) }} EGP</td>
                        <td>{{ $property->userCreated->username }}</td>
                        <td>{{ $property->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total Sales</th>
                        <th colspan="4"><span class="total_sale">{{ number_format($properties->sum('price'), 0) }}</span> EGP</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<form class="form-horizontal">
    <div class="bg-solid">
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9">
                <a href="{{ route('leads-pre-convert', array($lead->id)) }}" class="btn btn-primary btn-sm"><i class="ico-office mr5"></i>Add Property</a>
            </div>
        </div>
    </div>
</form>