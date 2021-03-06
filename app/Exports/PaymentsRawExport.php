<?php

namespace App\Exports;

use App\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentsRawExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Payment::all();
    }
}
