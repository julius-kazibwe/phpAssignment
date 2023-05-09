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
    if ($type == 'admin') {
        // Redirect to the admin dashboard
        return view('admin.adminpage');
    } else {
        // Redirect to the patient dashboard
        $final=Auth::user();
        $research = DB::table('patients')->where('email', $final->email)->first();
        return view('PatientManagement.patientDashboard', compact('research'));
    }
}

}

