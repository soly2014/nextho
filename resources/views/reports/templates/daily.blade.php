<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    {{ asset('stylesheet/excel_table.css') }}
    
    
    <table>
        <tr>
            <td colspan="5">Daily Repory ({{ $date }}
				@if(isset($end_date))
				{{ " - ".$end_date }}
				@endif
				)</td>
        </tr>
		 <tr>
			<td class="th">Client Name</td>
			<td class="th">Phone number</td>
			<td class="th">Client Request</td>
			<td class="th">Location</td>
			<td class="th">Marketing channel</td>
            <td class="th">New Client</td>
			<td class="th">Follow up</td>
            <td class="th">Call</td>
            <td class="th">Email</td>
            <td class="th">Meeting</td>
            <td class="th">Site Visit</td>
            <td class="th">Closing</td>
            <td class="th">Agent</td>
            <td class="th">Comment</td>
            <td class="th">Date</td>
        </tr>
		@foreach($report_date as $row)
        <tr>
			<td>{{ $row[0] }}</td>
			<td>{{ $row[1] }}</td>
			<td>{{ $row[2] }}</td>
			<td>{{ $row[3] }}</td>
			<td>{{ $row[4] }}</td>
			<td>{{ $row[5] }}</td>
			<td>{{ $row[6] }}</td>
			<td>{{ $row[7] }}</td>
			<td>{{ $row[8] }}</td>
            <td>{{ $row[9] }}</td>
			<td>{{ $row[10] }}</td>
			<td>{{ $row[11] }}</td>
			<td>{{ $row[12] }}</td>
			<td>{{ $row[13] }}</td>
			<td>{{ $row[14] }}</td>
        </tr>
        @endforeach
		
    </table>
</html>
