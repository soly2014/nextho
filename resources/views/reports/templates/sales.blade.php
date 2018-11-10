<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    {{ asset('stylesheet/excel_table.css') }}
    
    
    <table>
        <tr>
            <td colspan="5">Sales Report ({{ $start_date }} - {{ $end_date }})</td>
        </tr>
        <tr>
            <td class="th">Id</td>
            <td class="th">Client Name</td>
            <td class="th">Transaction Date</td>
            <td class="th">Client Source</td>
            <td class="th">Project/Unit Name</td>
            <td class="th">Unit Price</td>
            <td class="th">Phone Number</td>
            <td class="th">Address</td>
            <td class="th">Job Title</td>
            <td class="th">Company</td>
            <td class="th">Sold By</td>
        </tr>
        <?php 
            $counter = 0;
        ?>
        @foreach($sales as $sale)
        <tr>
            <td><?php echo ++$counter; ?></td>
            <td>{{ $sale->Client->name }} {{ $sale->Client->last_name }}</td>
            <td>{{ $sale->status_updated_at }}</td>
            <td>{{ $sale->Client->source->label }}</td>
            <?php
                $transName;
                $type = $sale->propertable_type;
                if($type == 'Project'){
                    $transName = $sale->Project->name;
                } else {
                    $transName = $sale->Unit->property_id;
                }
            ?>
            <td><?php echo $transName ?></td>
            <td>{{ number_format($sale->price, 0) }}</td>
            <td>{{ ($sale->Client->mobile) ? $sale->Client->mobile : $sale->Client->phone }}'</td>
            <td>{{ $sale->Client->street }}, {{ $sale->Client->city }}, {{ $sale->Client->country }}</td>
            <td>{{ $sale->Client->work_title }}</td>
            <td>{{ $sale->Client->company }}</td>
            <td>{{ $sale->userCreated->username }}</td>
        </tr>
        @endforeach
    </table>
    
</html>