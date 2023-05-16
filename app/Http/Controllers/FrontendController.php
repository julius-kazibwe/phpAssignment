<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\CenterSchedule;
use App\Center;
use App\Models\Time;
use App\Patient;
use App\Models\Vaccine;
use App\Models\Booking;
use App\Models\Perscription;





class FrontendController extends Controller
{
    public function index()
{
    date_default_timezone_set('Australia/Melbourne');
    if (request('date')) {
        $centers = $this->findCentersBasedOnDate(request('date'));
    } else {
        $centers = CenterSchedule::where('date', date('Y-m-d'))->get();
    }
    $center_names = [];
    foreach ($centers as $index=>$center) {
        $center_id = $center->center_id;
        $center_name = Center::where('center_id', $center_id)->value('center_name');
        $center_names[$index] = $center_name;
    }
    $center_vaccines = [];
    foreach ($centers as $index=>$center) {
        
        $centre = Center::where('center_id', $center->center_id)->first();
        $vaccine_id = $centre->vaccine_id;
        $vaccine_name = Vaccine::where('vaccine_id', $vaccine_id)->value('vaccine');
        $center_vaccines[$index] = $vaccine_name;
    }

    return view('welcome1', compact('centers', 'center_names', 'center_vaccines'));
}

    public function show($centerId, $date)
    {
        $appointment = Appointment::where('center_id', $centerId)->where('date', $date)->first();

        if (isset($appointment)){
            $times = Time::where('appointment_id', $appointment->id)->where('status', 0)->get();

        }else{
            // no times available
            return redirect()->back()->with('notime', 'Sorry, there are no available times for this center.');

        }
                                                   
        $user = Patient::where('email', auth()->user()->email)->first();
		
        $center_id = $centerId;
        $centerName = Center::where('center_id', $center_id)->first();
        $vaccine = Vaccine::where('vaccine_id', $centerName->vaccine_id)->first();
        
        return view('appointment', compact('times', 'date', 'user', 'center_id', 'centerName', 'vaccine' ));
    }


    public function findCentersBasedOnDate($date)
    {
        $centers = CenterSchedule::where('date', $date)->get();
        return $centers;
    }

    /*public function centerName($center_id){
        $center = Doctor::find($center_id);
        
        return $center->name;
    }
*/
    public function store(Request $request)
    {
        date_default_timezone_set('Africa/Tunis');

        $request->validate(['time' => 'required']);
        $check = $this->checkBookingTimeInterval();
        if ($check) {
            return redirect()->back()->with('errmessage', 'You already made an appointment, Please wait to make next appointment');
        }


        Booking::create([
            'user_id' => auth()->user()->id,
            'center_id' => $request->centerId,
            'time' => $request->time,
            'date' => $request->date,
            'status' => 0

        ]);

       Time::where('appointment_id', $request->appointmentId)->where('time', $request->time)->update(['status' => 1]);

        return redirect()->back()->with('message', 'Your appointment was booked');
    }


    public function checkBookingTimeInterval()
    {
        return Booking::orderby('id', 'desc')->where('user_id', auth()->user()->id)->whereDate('created_at', date('Y-m-d'))->exists();
    }

    public function myBookings()
    {
        $appointments = Booking::latest()->where('user_id', auth()->user()->id)->get();
        $centerIds = [];
     foreach ($appointments as $appointment) {
    $centerIds[] = $appointment->center_id;
}

        $center_names = [];
    foreach ($centerIds as $center_id) {
      
        $center_name = Center::where('center_id', $center_id)->value('center_name');
        $center_names[$center_id] = $center_name;
    }
        return view('booking.index', compact('appointments', 'center_names', 'centerIds' ));
    }

    public function centerToday()
    {
        $centers = CenterSchedule::with('center')->whereDate('date', date('Y-m-d'))->get();
        return $centers;
    }

    public function findCenters(Request $request)
    {
        $centers = CenterSchedule::with('center')->whereDate('date', $request->date)->get();
        return $centers;
    }

    public function myPerscription()
    {
        $perscriptions = Perscription::where('user_id', auth()->user()->id)->get();
        return view('my-perscription', compact('perscriptions'));
    }
}
