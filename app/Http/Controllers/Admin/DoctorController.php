<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    public function index()
    {
        return view('admin.doctors.index');
    }

    /**
     * Show the form for editing the specified resource.
     * The parameter is a User model that has the 'Doctor' role.
     */
    public function edit(User $doctor)
    {
        $doctor->load('doctor'); // Eager load the doctor relationship
        $specialities = Specialty::all();
        return view('admin.doctors.edit', [
            'user' => $doctor,
            'specialities' => $specialities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * The parameter is the User model, not the Doctor model.
     */
    public function update(Request $request, User $doctor)
    {
        $validated = $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'medical_license_number' => 'required|string|max:255',
            'biography' => 'required|string',
        ]);

        // Use updateOrCreate to handle both new and existing doctor records
        $doctor->doctor()->updateOrCreate(
            ['user_id' => $doctor->id], // Condition to find the record
            $validated // Data to update or create
        );

        session()->flash('flash.banner', '¡La información del doctor ha sido actualizada exitosamente!');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('admin.doctors.index');
    }

    /**
     * Show the form for managing the doctor's schedules.
     */
    public function schedules(User $doctor)
    {
        // Ensure the doctor relationship exists, if not, create it.
        $doctor->doctor()->firstOrCreate([]);

        // Load the schedules for the doctor profile
        $doctor->load('doctor.schedules');

        return view('admin.doctors.schedules', compact('doctor'));
    }

    /**
     * Store the doctor's schedules.
     */
    public function storeSchedules(Request $request, User $user)
    {
        $request->validate([
            'schedules' => 'required|array',
            'schedules.*.start_time' => 'nullable|date_format:H:i',
            'schedules.*.end_time' => 'nullable|date_format:H:i|after:schedules.*.start_time',
        ]);

        // Ensure the doctor relationship exists, if not, create it.
        $doctor = $user->doctor()->firstOrCreate([]);
        $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        $schedules = $request->input('schedules', []);

        foreach ($days as $day) {
            $scheduleData = $schedules[$day] ?? null;

            // If start and end times are provided, create or update the schedule
            if (!empty($scheduleData['start_time']) && !empty($scheduleData['end_time'])) {
                $status = isset($scheduleData['status']) ? 'active' : 'inactive';
                $doctor->schedules()->updateOrCreate(
                    ['day_of_week' => $day],
                    [
                        'start_time' => $scheduleData['start_time'],
                        'end_time' => $scheduleData['end_time'],
                        'status' => $status,
                    ]
                );
            } else {
                // If times are empty for a specific day, delete the schedule for that day
                $doctor->schedules()->where('day_of_week', $day)->delete();
            }
        }

        session()->flash('flash.banner', '¡Los horarios del doctor han sido actualizados exitosamente!');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('admin.doctors.edit', $user);
    }
}
