<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    {{ asset('stylesheet/excel_table.css') }}
    
    
    <table>
        <tr>
            <td colspan="5">Clients Acquisition Report({{ $start_date }} - {{ $end_date }})</td>
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
        @if($projects_only)
            
        
            @foreach($clients as $client)
                @if($client->firstProperty->propertable_type == 'Project')
                <tr>
                    <td><?php echo ++$counter; ?></td>
                    <td>{{ $client->name }} {{ $client->last_name }}</td>
                    <td>{{ $client->customer_date }}</td>
                    <td>{{ $client->source->label }}</td>
                    <td>{{ $client->firstProperty->Project->name }}</td>
                    <td>{{ number_format($client->firstProperty->price, 0) }}</td>
                    <td>{{ ($client->mobile) ? $client->mobile : $client->phone }}'</td>
                    <td>{{ $client->street }}, {{ $client->city }}, {{ $client->country }}</td>
                    <td>{{ $client->work_title }}</td>
                    <td>{{ $client->company }}</td>
                    <td>{{ $client->firstProperty->userCreated->username }}</td>
                </tr>
                @endif
            @endforeach
        
            
        @elseif($units_only)
        
            @foreach($clients as $client)
                @if($client->firstProperty->propertable_type == 'Unit')
                <tr>
                    <td><?php echo ++$counter; ?></td>
                    <td>{{ $client->name }} {{ $client->last_name }}</td>
                    <td>{{ $client->customer_date }}</td>
                    <td>{{ $client->source->label }}</td>
                    <td>{{ $client->firstProperty->Unit->property_id }}</td>
                    <td>{{ number_format($client->firstProperty->price, 0) }}</td>
                    <td>{{ ($client->mobile) ? $client->mobile : $client->phone }}'</td>
                    <td>{{ $client->street }}, {{ $client->city }}, {{ $client->country }}</td>
                    <td>{{ $client->work_title }}</td>
                    <td>{{ $client->company }}</td>
                    <td>{{ $client->firstProperty->userCreated->username }}</td>
                </tr>
                @endif
            @endforeach
        
        @else
            @foreach($clients as $client)
            <tr>
                <td><?php echo ++$counter; ?></td>
                <td>{{ $client->name }} {{ $client->last_name }}</td>
                <td>{{ $client->customer_date }}</td>
                <td>{{ $client->source->label }}</td>
                <?php
                    $transName;
                    $type = $client->firstProperty->propertable_type;
                    if($type == 'Project'){
                        $transName = $client->firstProperty->Project->name;
                    } else {
                        $transName = $client->firstProperty->Unit->property_id;
                    }
                ?>
                <td><?php echo $transName ?></td>
                <td>{{ number_format($client->firstProperty->price, 0) }}</td>
                <td>{{ ($client->mobile) ? $client->mobile : $client->phone }}'</td>
                <td>{{ $client->street }}, {{ $client->city }}, {{ $client->country }}</td>
                <td>{{ $client->work_title }}</td>
                <td>{{ $client->company }}</td>
                <td>{{ $client->firstProperty->userCreated->username }}</td>
            </tr>
            @endforeach
        @endif
    </table>
    
</html>