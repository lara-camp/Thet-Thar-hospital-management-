<?php

namespace App\UseCases\Doctors;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Helpers\FileHelper;
use App\Models\HospitalDoctor;
use Illuminate\Support\Facades\DB;

class StoreDoctorAction
{
    public function __invoke($formData): int
    {
        $doctor = $this->createDoctor($formData);
        $this->createHospitalDoctorPivot($formData['hospital_id'], $doctor->id);
        $this->uploadImage($formData, $doctor);
        $this->createAppointmentTimes($formData, $doctor);
        $this->updateDoctorRole($doctor->userInfo);

        return 201;
    }

    private function createDoctor($formData)
    {
        DB::beginTransaction();
        try {
            $doctor = Doctor::create($formData);
            DB::commit();
            return $doctor;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function createHospitalDoctorPivot($hospitalId, $doctorId)
    {
        HospitalDoctor::create([
            'hospital_id' => $hospitalId,
            'doctor_id' => $doctorId,
        ]);
    }

    private function uploadImage($formData, $doctor)
    {
        if (isset($formData['image'])) {
            $fileName = FileHelper::fileMover($formData['image']);
            $doctor->images()->create([
                'url' => config('folderName') . '/' . $fileName,
            ]);
        }
    }

    private function createAppointmentTimes($formData, $doctor)
    {
        $startTime = Carbon::parse($formData['duty_start_time']);
        $endTime = Carbon::parse($formData['duty_end_time']);
        $interval = 30; // 30 minutes interval, you can adjust this as needed

        while ($startTime <= $endTime) {
            $doctor->appointmentTimes()->create([
                'doctor_id' => $doctor->id,
                'appointment_time' => $startTime->format('H:i'),
            ]);

            $startTime->addMinutes($interval);
        }
    }

    private function updateDoctorRole($userInfo)
    {
        $userInfo->update([
            'role' => 'doctor',
        ]);
    }
}
