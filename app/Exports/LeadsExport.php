<?php

namespace App\Exports;

use \App\Models\Client;
use \Maatwebsite\Excel\Concerns\{Exportable,FromQuery,WithMapping,WithHeadings};
use \PhpOffice\PhpSpreadsheet\Shared\Date;

class LeadsExport implements FromQuery, WithMapping, WithHeadings
{   
	/**
	 * 
	 */
    use Exportable;
    /**
     * [__construct description]
     * @param array $ids [description]
     */
    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }
    /**
     * [query description]
     * @return [type] [description]
     */
    public function query()
    {
        return Client::query()->whereIn('id', $this->ids);
    }
    /**
     * [map description]
     * @param  [type] $lead [description]
     * @return [type]       [description]
     */
    public function map($lead): array
    {
        if ($lead->sub()->first()) {
	        $sub = $lead->sub()->first();
	        return [
	            trim($lead->name.' '.$lead->last_name),
	            trim($lead->Phone.' '.$lead->mobile.' '.$lead->mobile_two.' '.$sub->phone.' '.$sub->mobile_one.' '.$sub->mobile_two),
	            trim($lead->international_number.' '.$sub->international_number),
	            trim($lead->email.' '.$lead->secondary_email.' '.$sub->email),
	        ];
        } else {
	 
	        return [
	            trim($lead->name.' '.$lead->last_name),
	            trim($lead->Phone.' '.$lead->mobile.' '.$lead->mobile_two),
	            trim($lead->international_number),
	            trim($lead->email.' '.$lead->secondary_email),
	        ];
        }
        

    }
    /**
     * [headings description]
     * @return [type] [description]
     */
    public function headings(): array
    {
        return [
            'client name',
            'Numbers',
            'International Numbers',
            'Emails'
        ];// client name,numbers,international numbers,emails
    }
}