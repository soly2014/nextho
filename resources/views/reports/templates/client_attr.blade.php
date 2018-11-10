<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    {{ asset('stylesheet/excel_table.css') }}
    
    
    <table>
        <tr>
            <td colspan="5">Clients Attributes - ({{ $date }}
				@if(isset($end_date))
				{{ " - ".$end_date }}
				@endif
				)</td>
        </tr>
		 <tr>
			<td class="th">Client Name</td>
			 @foreach($output as $data)
				<td class="th">{{ $data }}</td>
			 @endforeach
        </tr>
		@foreach($report_date as $row)
        <tr>
			<td>{{ $row["name"] }} {{ $row["last_name"] }}</td>
			@if(in_array("Phone", $output))
			<td>'{{ $row["Phone"] }}</td>
			@endif
			@if(in_array("mobile", $output))
				<td>'{{ $row["mobile"] }}</td>
			@endif
			@if(in_array("email", $output))
				<td>{{ $row["email"] }}</td>
			@endif
			@if(in_array("secondary_email", $output))
			<td>{{ $row["secondary_email"] }}</td>
			@endif
        </tr>
        @endforeach
		
    </table>
</html>
