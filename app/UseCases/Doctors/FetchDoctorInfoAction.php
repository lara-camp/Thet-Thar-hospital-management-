<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;

class FetchDoctorInfoAction
{
    public function __invoke($doctor)
    {
        $doctorId = $doctor->doctor->id;

        $appointmentCount = $this->getDoctorAppointmentCount($doctorId);
        $hospitalCount = $this->getDoctorHospitalCount($doctorId);
        $patientCount = $this->getDoctorPatientCount($doctorId);

        $data = [
            'hospitalCount' => $hospitalCount,
            'patientCount' => $patientCount,
            'appointmentCount' => $appointmentCount,
        ];

        return $data;
    }

    private function getDoctorAppointmentCount($doctorId): int
    {
        $doctor = Doctor::with('appointments')->where('id', $doctorId)->first();
        return $doctor ? $doctor->appointments()->count() : 0;
    }

    private function getDoctorHospitalCount($doctorId): int
    {
        $doctor = Doctor::with('hospitals')->where('id', $doctorId)->first();
        return $doctor ? $doctor->hospitals()->count() : 0;
    }

    private function getDoctorPatientCount($doctorId): int
    {
        $patients = Doctor::with('patients')->where('id', $doctorId)->first();
        if (!$patients) {
            return 0;
        }
        return $patients->patients->count();
    }
}
