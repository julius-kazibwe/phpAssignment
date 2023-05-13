<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Patient;
use App\Doctor;
class PatientlistController extends Controller
{
    public function index(Request $request)
    {
        date_default_timezone_set('Africa/Tunis');
        if ($request->date) {
            $bookings = Booking::latest()->where('date', $request->date)->get();
            $doctorIds = [];
        foreach ($bookings as $booking) {
       $doctorIds[] = $booking->doctor_id;
   }
        
        $doctor_names = [];
        foreach ($doctorIds as $doctor_id) {
           // $doctor_id = $doctor->doctor_id;
            $doctor_name = Doctor::where('doctor_id', $doctor_id)->value('fullname');
            $doctor_names[$doctor_id] = $doctor_name;
        }
            return view('Doctoradmin.patientlist.index', compact('bookings', 'doctor_names', 'doctorIds'));
        }
        $bookings = Booking::latest()->where('date', date('Y-m-d'))->get();

        $doctorIds = [];
        foreach ($bookings as $booking) {
       $doctorIds[] = $booking->doctor_id;
   }
        
        $doctor_names = [];
        foreach ($doctorIds as $doctor_id) {
           // $doctor_id = $doctor->doctor_id;
            $doctor_name = Doctor::where('doctor_id', $doctor_id)->value('fullname');
            $doctor_names[$doctor_id] = $doctor_name;
        }
        
        return view('Doctoradmin.patientlist.index', compact('bookings', 'doctor_names', 'doctorIds'));
    }

    public function toggleStatus($id)
    {
        $booking = Booking::find($id);
        $booking->status = !$booking->status;
        $booking->save();
        return redirect()->back();
    }
    public function allTimeAppointment()
    {
        $bookings = Booking::latest()->paginate(20);
        $doctorIds = [];
        foreach ($bookings as $booking) {
       $doctorIds[] = $booking->doctor_id;
   }
        
        $doctor_names = [];
        foreach ($doctorIds as $doctor_id) {
           // $doctor_id = $doctor->doctor_id;
            $doctor_name = Doctor::where('doctor_id', $doctor_id)->value('fullname');
            $doctor_names[$doctor_id] = $doctor_name;
        }
        
        return view('Doctoradmin.patientlist.index', compact('bookings', 'doctor_names', 'doctorIds'));
        
        
    }
}
