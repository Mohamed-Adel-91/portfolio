<?php
namespace App\Exports;

use App\Models\ContactUs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactUsExport implements FromQuery, WithHeadings, WithMapping
{

    public function query()
    {
        return ContactUs::query();
    }

    public function headings(): array
    {
        return [
            '#',
            'full_name',
            'role',
            'email',
            'mobile',
            'country',
            'website',
            'details',
            'Created At',
        ];
    }

    public function map($contactUs): array
    {
        return [
            $contactUs->id,
            $contactUs->full_name,
            $contactUs->role,
            $contactUs->email,
            $contactUs->mobile,
            $contactUs->country,
            $contactUs->website,
            $contactUs->details,
            $contactUs->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
