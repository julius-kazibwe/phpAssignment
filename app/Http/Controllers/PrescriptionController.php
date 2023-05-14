<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Prescription;
use App\Patient;
use App\User;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function home2(Request $request){
        $prescriptions = Prescription::all();
        return view('home_prescription',['prescriptions'=>$prescriptions]);
    }

    public function add2(Request $request){
        $this->validate($request,[
            'center_id'=>'required',
            'patient_id' => 'required',
            'vaccine' => 'required'
        ]);
    
        $prescriptions = new Prescription;
        $prescriptions->center_id = $request->input('center_id');
        $prescriptions->patient_id = $request->input('patient_id');
        $prescriptions->vaccine = $request->input('vaccine');
    
        $prescriptions->save();
        return redirect('/home_prescription')->with('info','prescription saved successfully!');
    }

    public function edit2($id)
    {
        $prescription = Prescription::findOrFail($id);
    
        return view('update_prescription', compact("prescription"));
    }

    public function update2(Request $request)
    {
        $this->validate($request,[
            'center_id'=>'required',
            'patient_id' => 'required',
            'vaccine' => 'required'
        ]);
        $id = $request->id;
        $prescription= Prescription::findOrFail($id);
        $prescription->center_id = $request->center_id;
        $prescription->patient_id = $request->patient_id;
        $prescription->vaccine = $request->vaccine;

        $prescription->save();
        return redirect('/home_prescription')->with('success','Prescription Updated');
    }

    public function show()
    {
        $currentPatient = Patient::where('email', auth()->user()->email)->first();
        $patient_id = $currentPatient->patient_id;

        $prescription = Prescription::where('patient_id', $patient_id)->get();
        if ($prescription !== null) {
            return view('read_prescription', compact('prescription'));
        } else {
            return redirect()->back()->withErrors(['No prescriptions found for the patient.']);
        }
        
    }
    public function show2(Prescription $prescription,$id)
    {
        $prescription = Prescription::find($id);
        return view('read_prescriptionadmin',compact('prescription'));
    }

    public function destroy(Prescription $prescription,$id)
    {
        $prescription = Prescription::find($id);
        $prescription->delete();
  
        return redirect('/home_prescription')->with('success','Prescription deleted successfully');
    }

    public function reports()
    {
        $prescriptions =Prescription::paginate(10);
        return view('report_prescription', compact('prescriptions'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $prescriptions = DB::table('prescriptions')->where('id','like', '%'.$search.'%')
                                         ->orwhere('center_id','like','%'.$search.'%')
                                         ->orwhere('patient_id','like','%'.$search.'%')
                                         ->paginate(10);
        return view('report_prescription', ['prescriptions' => $prescriptions]);
    }
}
