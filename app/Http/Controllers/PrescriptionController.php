<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Prescription;
use App\Patient;
use App\User;
use DB;
use App\Models\Vaccine;
use App\Center;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function home2(Request $request){
        $prescriptions = Prescription::all();
        
        $centers= [];
        foreach($prescriptions as $index => $p){
           
            $treatmentCenter = Prescription::where('center_id', $p->center_id)->first();
            $center =Center::where('center_id', $treatmentCenter->center_id)->first();
            $centers[$index]=$center->center_name;
    
        }
        $vaccines= [];
        foreach($prescriptions as $index => $p){
            
            $treatmentvaccine = Prescription::where('vaccine', $p->vaccine)->first();
            $vaccine = Vaccine::where('vaccine_id', $treatmentvaccine->vaccine)->first();
            $vaccines[$index]=$vaccine->vaccine;
    
        }
        
        $patients = [];
        
        foreach ($prescriptions as $index => $p) {
            
            $patient= Prescription::where('patient_id', $p->patient_id)->first();
            $patient_name = Patient::where('patient_id', $patient->patient_id)->first();
            $patients[$index] = $patient_name->fullname;
            
        }
        return view('home_prescription', compact('prescriptions','patients','vaccines','centers'));

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

    public function update2($id)
    {
        $prescription = Prescription::findOrFail($id);
    
        return view('update_prescription', compact("prescription"));
    }

    public function edit2(Request $request, $id)
    {
        $this->validate($request,[
            'center_id'=>'required',
            'patient_id' => 'required',
            'vaccine' => 'required'
        ]);

        $query = Prescription::where('id', $id)->update([
            'center_id' => $request->input('center_id'),
            'vaccine' => $request->input('vaccine'),
            'patient_id' => $request->input('patient_id')
    
        ]);
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
        
       
        $centers= [];
        foreach($prescription as $index => $p){
           
            $treatmentCenter = Prescription::where('center_id', $p->center_id)->first();
            $center =Center::where('center_id', $treatmentCenter->center_id)->first();
            $centers[$index]=$center->center_name;
    
        }
        $vaccines= [];
        foreach($prescription as $index => $p){
            
            $treatmentvaccine = Prescription::where('vaccine', $p->vaccine)->first();
            $vaccine = Vaccine::where('vaccine_id', $treatmentvaccine->vaccine)->first();
            $vaccines[$index]=$vaccine->vaccine;
    
        }
        
       

        return view('read_prescription', compact('prescription','currentPatient', 'centers','vaccines'));
    }

    public function show2(Prescription $prescription,$id)
    {
        $prescription = Prescription::where('id', $id)->first();

        $center =Center::where('center_id', $prescription->center_id)->value('center_name');

        $vaccine =Vaccine::where('vaccine_id', $prescription->vaccine)->value('vaccine');

        $patient = Patient::where('patient_id', $prescription->patient_id)->value('fullname');

        return view('read_prescriptionadmin',compact('prescription', 'center','vaccine', 'patient'));
    
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
        $centers = [];
        foreach ($prescriptions as $index=> $prescription) {
            $center_id = $prescription->center_id;
            $center_name = Center::where('center_id', $center_id)->value('center_name');
            $centers[$index] = $center_name;
        }

        $vaccines = [];
        foreach ($prescriptions as $index=> $prescription) {
            $vaccine_id = $prescription->vaccine;
            $vaccine_name = Vaccine::where('vaccine_id', $vaccine_id)->value('vaccine');
            $vaccines[$index] = $vaccine_name;
        }
        $patients = [];
        
        foreach ($prescriptions as $index=> $prescription) {
            $patient_id = $prescription->patient_id;
            $patient_name = Patient::where('patient_id', $patient_id)->value('fullname');
            $patients[$index] = $patient_name;
        }



        return view('report_prescription',compact('prescriptions','centers','patients','vaccines'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $prescriptions = DB::table('prescriptions')->where('id','like', '%'.$search.'%')
                                         ->paginate(10);
                                         $centers = [];
                                         foreach ($prescriptions as $index=> $prescription) {
                                             $center_id = $prescription->center_id;
                                             $center_name = Center::where('center_id', $center_id)->value('center_name');
                                             $centers[$index] = $center_name;
                                         }
                                 
                                         $vaccines = [];
                                         foreach ($prescriptions as $index=> $prescription) {
                                             $vaccine_id = $prescription->vaccine;
                                             $vaccine_name = Vaccine::where('vaccine_id', $vaccine_id)->value('vaccine');
                                             $vaccines[$index] = $vaccine_name;
                                         }
                                         $patients = [];
                                         
                                         foreach ($prescriptions as $index=> $prescription) {
                                             $patient_id = $prescription->patient_id;
                                             $patient_name = Patient::where('patient_id', $patient_id)->value('fullname');
                                             $patients[$index] = $patient_name;
                                         }
                                 
                                 
                                 
                                         return view('report_prescription',compact('prescriptions','centers','patients','vaccines'));
                                     }
                                 
}
