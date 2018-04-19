<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    {{ asset('stylesheet/excel_table.css') }}
    
    
    <table>
        <tr>
            <td colspan="3">Clients Sources Report({{ $start_date }} - {{ $end_date }})</td>
        </tr>
        <tr>
            <td class="th">Id</td>
            <td class="th">Source Name</td>
            <td class="th">Clients #</td>
            <td class="th">Percentage</td>

        </tr>
        <?php 
            $counter = 0;
        ?>
        @foreach($clients as $client)
        <tr>
            <td><?php echo ++$counter; ?></td>
            <td>{{ $client->source->label }}</td>
            @if(isset($leads) && $leads)
            <td>{{ $client->source->leadsCount}}</td>
            <td><?php echo round((($client->source->leadsCount*100)/$clients_count), 2); ?>%</td>
            @else
            <td>{{ $client->source->customersCount }}</td>
            <td><?php echo round((($client->source->customersCount *100)/$clients_count), 2); ?>%</td>
            @endif
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td>Total</td>
            <td>{{ $clients_count }}</td>
            <td>100%</td>
        </tr>
    </table>
</html>