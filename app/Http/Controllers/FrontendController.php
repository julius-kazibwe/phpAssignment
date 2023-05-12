<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\DoctorSchedule;
use App\Doctor;
use App\Models\Time;
use App\Patient;
use App\Models\Vaccine;
use App\Models\Booking;
use App\Models\Perscription;
use App\Mail\AppointmentMail;
use Illuminate\Support\Facades\Mail;



class FrontendController extends Controller
{
    public function index()
{
    date_default_timezone_set('Australia/Melbourne');
    if (request('date')) {
        $doctors = $this->findDoctorsBasedOnDate(request('date'));
    } else {
        $doctors = DoctorSchedule::where('date', date('Y-m-d'))->get();
    }

    $doctor_names = [];
    foreach ($doctors as $doctor) {
        $doctor_id = $doctor->doctor_id;
        $doctor_name = Doctor::where('doctor_id', $doctor_id)->value('fullname');
        $doctor_names[$doctor_id] = $doctor_name;
    }

    return view('welcome1', compact('doctors', 'doctor_names'));
}

    public function show($doctorId, $date)
    {
        $appointment = DoctorSchedule::where('doctor_id', $doctorId)->where('date', $date)->first();
        $times = Time::where('appointment_id', $appointment->id)->where('status', 0)->get();
	
                                                   
        $user = Patient::where('email', auth()->user()->email)->first();
		
        $doctor_id = $doctorId;

        return view('appointment', compact('times', 'date', 'user', 'doctor_id'));
    }


    public function findDoctorsBasedOnDate($date)
    {
        $doctors = DoctorSchedule::where('date', $date)->get();
        return $doctors;
    }

    /*public function docName($doctor_id){
        $doctor = Doctor::find($doctor_id);
        
        return $doctor->name;
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
            'doctor_id' => $request->doctorId,
            'time' => $request->time,
            'date' => $request->date,
            'status' => 0

        ]);

        Time::where('appointment_id', $request->appointmentId)->where('time', $request->time)->update(['status' => 1]);
        $doctorName = Doctor::where('doctor_id', $request->doctorId)->first();
        $mailData = [
            'name' => auth()->user()->name,
            'time' => $request->time,
            'date' => $request->date,
            'doctorName' => $doctorName->name
        ];


        Mail::to(auth()->user()->email)->send(new AppointmentMail($mailData));

        return redirect()->back()->with('message', 'Your appointment was booked');
    }


    public function checkBookingTimeInterval()
    {
        return Booking::orderby('id', 'desc')->where('user_id', auth()->user()->id)->whereDate('created_at', date('Y-m-d'))->exists();
    }

    public function myBookings()
    {
        $appointments = Booking::latest()->where('user_id', auth()->user()->id)->get();
        return view('booking.index', compact('appointments'));
    }

    public function doctorToday()
    {
        $doctors = DoctorSchedule::with('doctor')->whereDate('date', date('Y-m-d'))->get();
        return $doctors;
    }

    public function findDoctors(Request $request)
    {
        $doctors = DoctorSchedule::with('doctor')->whereDate('date', $request->date)->get();
        return $doctors;
    }

    public function myPerscription()
    {
        $perscriptions = Perscription::where('user_id', auth()->user()->id)->get();
        return view('my-perscription', compact('perscriptions'));
    }
}
