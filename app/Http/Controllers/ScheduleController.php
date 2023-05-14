<?php

namespace App\Http\Controllers;

use DB;
use App\Center;
use App\Models\CenterSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function schedule($center_id)
{
    $center = Center::where('center_id', $center_id)->firstOrFail();

    //$center = Center::findOrFail($center_id);
    $schedules = CenterSchedule::where('center_id', $center_id)->get();
    return view('schedule.index', compact('center', 'schedules'));
}

public function store(Request $request, $center_id)
{
    // Validate the input fields
    $request->validate([
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
    ]);

    // Get the doctor
    $center = Center::findOrFail($center_id);

    // Check if the doctor already has a schedule on the given date
    $existingSchedule = CenterSchedule::where('center_id', $center_id)
        ->where('date', $request->date)
        ->first();

    if ($existingSchedule) {
        // Redirect back with an error message
        return redirect()->back()->with('error', 'The center already has a schedule on the given date.');
    }

    // Save the new schedule
    $schedule = new CenterSchedule();
    $schedule->center_id = $center_id;
    $schedule->date = $request->date;
    $schedule->start_time = $request->start_time;
    $schedule->end_time = $request->end_time;
    $schedule->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'The schedule has been added successfully.');
}

}
