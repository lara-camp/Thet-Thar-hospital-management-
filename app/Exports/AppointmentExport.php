<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromCollection;

class AppointmentExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Appointment::with('doctor', 'patient')->where('doctor_id', auth()->user()->doctor->id)->get();
        return collect($data);
    }
}
