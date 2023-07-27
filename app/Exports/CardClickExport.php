<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CardClickExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    protected $headers;

    protected $collection;

    public function __construct($data)
    {
        $this->headers = $data[0];

        $this->collection = collect($data[1]);
    }

    public function headings(): array
    {
        return $this->headers;
    }

    public function collection()
    {
        return $this->collection;
    }

}
