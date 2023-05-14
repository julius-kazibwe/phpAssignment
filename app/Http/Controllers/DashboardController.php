<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Patient;
use App\User;
use Alert;
use Illuminate\Http\Request;

class DashboardController extends Controller{
    public function index($type)
{
    $final=Auth::user();

    if ($type == 'admin') {
        // Redirect to the admin dashboard
        $research = DB::table('users')->where('email', $final->email)->first();
        return view('Centeradmin.adminpage', compact('research'));
    } else {
        // Redirect to the patient dashboard
        
        $research = DB::table('patients')->where('email', $final->email)->first();
        return view('PatientManagement.patientDashboard', compact('research'));
    }
}

}

