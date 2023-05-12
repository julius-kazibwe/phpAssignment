<?php

namespace App\Http\Controllers;

use DB;
use App\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function schedule($doctor_id)
{
    $doctor = Doctor::where('doctor_id', $doctor_id)->firstOrFail();

    //$doctor = Doctor::findOrFail($doctor_id);
    $schedules = DoctorSchedule::where('doctor_id', $doctor_id)->get();
    return view('schedule.index', compact('doctor', 'schedules'));
}

public function store(Request $request, $doctor_id)
{
    // Validate the input fields
    $request->validate([
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
    ]);

    // Get the doctor
    $doctor = Doctor::findOrFail($doctor_id);

    // Check if the doctor already has a schedule on the given date
    $existingSchedule = DoctorSchedule::where('doctor_id', $doctor_id)
        ->where('date', $request->date)
        ->first();

    if ($existingSchedule) {
        // Redirect back with an error message
        return redirect()->back()->with('error', 'The doctor already has a schedule on the given date.');
    }

    // Save the new schedule
    $schedule = new DoctorSchedule();
    $schedule->doctor_id = $doctor_id;
    $schedule->date = $request->date;
    $schedule->start_time = $request->start_time;
    $schedule->end_time = $request->end_time;
    $schedule->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'The schedule has been added successfully.');
}

}
