<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Patient;
use App\Center;
class PatientlistController extends Controller
{
    public function index(Request $request)
    {
        date_default_timezone_set('Africa/Tunis');
        if ($request->date) {
            $bookings = Booking::latest()->where('date', $request->date)->get();
            $centerIds = [];
        foreach ($bookings as $booking) {
       $centerIds[] = $booking->center_id;
   }
        
        $center_names = [];
        foreach ($centerIds as $index=>$center_id) {
            $center_name = Center::where('center_id', $center_id)->value('center_name');
            $center_names[$index] = $center_name;
        }
            return view('Centeradmin.patientlist.index', compact('bookings', 'center_names', 'centerIds'));
        }
        $bookings = Booking::latest()->where('date', date('Y-m-d'))->get();

        $centerIds = [];
        foreach ($bookings as $booking) {
       $centerIds[] = $booking->center_id;
   }
        
        $center_names = [];
        foreach ($centerIds as $index=>$center_id) {
           
            $center_name = Center::where('center_id', $center_id)->value('center_name');
            $center_names[$index] = $center_name;
        }
        
        return view('Centeradmin.patientlist.index', compact('bookings', 'center_names'));
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
        $centerIds = [];
        foreach ($bookings as $booking) {
       $centerIds[] = $booking->center_id;
   }
        
        $center_names = [];
        foreach ($centerIds as $index=> $center_id) {
           
            $center_name = Center::where('center_id', $center_id)->value('center_name');
            $center_names[$index] = $center_name;
        }
        
        return view('Centeradmin.patientlist.index', compact('bookings', 'center_names'));
        
        
    }
}
