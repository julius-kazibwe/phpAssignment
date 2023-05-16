<?php

namespace App\Http\Controllers;

use App\TreatmentRecord;
use App\Patient;
use App\User;
use App\Center;
use App\Models\Vaccine;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class TreatmentController extends Controller
{
    public function index1(Request $request){
        $treatment_records = TreatmentRecord::all();
        

        $center_names = [];
        foreach ($treatment_records as $index =>  $treat) {
            $center_id = $treat->center_id;
            $center_name = Center::where('center_id', $center_id)->value('center_name');
            $center_names[$index] = $center_name;
        }

        $vaccines = [];
        foreach ($treatment_records as $index => $treat) {
            $vaccine_id = $treat->vaccine_id;
            $vaccine_name = Vaccine::where('vaccine_id', $vaccine_id)->value('vaccine');
            $vaccines[$index] = $vaccine_name;
        }
        $patients = [];
        $nin = [];
        
        foreach ($treatment_records as $index => $treat) {
            $patient_id = $treat->patient_id;
            $patient_name = Patient::where('patient_id', $patient_id)->value('fullname');
            $patients[$index] = $patient_name;
            $ninp = Patient::where('patient_id', $patient_id)->value('nin');
            $nin[$index] = $ninp;
        }
        
       


        return view('home_treat',compact('patients','vaccines','center_names','treatment_records', 'nin'));
    }

    public function add1(Request $request){
        $this->validate($request,[
            'center_id'=>'required',
            'patient_id' => 'required',
            'date' => 'required',
            'vaccine' => 'required'
        ]);
    
        $treatment_records = new TreatmentRecord;
        $treatment_records->center_id = $request->input('center_id');
        $treatment_records->patient_id = $request->input('patient_id');
        $treatment_records->date = $request->input('date');
        $treatment_records->vaccine_id = $request->input('vaccine');
    
        $treatment_records->save();
        return redirect('/home_treat')->with('info','Vaccination record saved successfully!');
    }

    public function update1( $id)
    {
        $treatment_record = TreatmentRecord::where('record_id',$id)->first();
       
        return view('update_treat',compact('treatment_record'));
    }
    

    public function edit1(Request $request, $record_id)
    {
        $request->validate([
            'center_id'=>'required',
            'patient_id' => 'required',
            'date' => 'required',
            'vaccine' => 'required'
        ]);
       
      $query = TreatmentRecord::where('record_id', $record_id)->update([
        'center_id' => $request->input('center_id'),
        'date' => $request->input('date'),
        'vaccine_id' => $request->input('vaccine'),
        'patient_id' => $request->input('patient_id')

    ]);
    

      $treatment_records = TreatmentRecord::where('record_id', $record_id)->first();
        $treatment_records->center_id = $request->input('center_id');
        $treatment_records->patient_id = $request->input('patient_id');
        $treatment_records->vaccine_id = $request->input('vaccine');
        $treatment_records->date = $request->input('date');
        
    
        $treatment_records->save();
  
        return redirect('home_treat')->with('success','Vaccination updated successfully');
    }

    public function show($id)
    {
        $treatment_record = TreatmentRecord::where('record_id',$id)->first();
        $center_name = Center::where('center_id', $treatment_record->center_id)->value('center_name');
        $patient_name = Patient::where('patient_id', $treatment_record->patient_id)->value('fullname');
        $vaccine_name = Vaccine::where('vaccine_id', $treatment_record->vaccine_id)->value('vaccine');
        $nin = Patient::where('patient_id', $treatment_record->patient_id)->value('nin');

        return view('read_treat',compact('treatment_record','center_name','patient_name','vaccine_name', 'nin'));
    }

    public function read($id)
    {
        $currentPatient = Patient::where('email', auth()->user()->email)->first();
        $patient_id = $currentPatient->patient_id;

        $treatment_record = TreatmentRecord::where('patient_id', $patient_id)->get();

        $centers= [];
        foreach($treatment_record as $index => $treat){
            
            $treatmentCenter = TreatmentRecord::where('center_id', $treat->center_id)->first();
            $center =Center::where('center_id', $treatmentCenter->center_id)->first();
            $centers[$index]=$center->center_name;
    
        }
        $vaccines= [];
        foreach($treatment_record as $index => $treat){
            //$pi= $treat->record_id;
            $treatmentCenter = TreatmentRecord::where('vaccine_id', $treat->vaccine_id)->first();
            $vaccine = Vaccine::where('vaccine_id', $treatmentCenter->vaccine_id)->first();
            $vaccines[$index]=$vaccine->vaccine;
    
        }
        

        return view('read_treatment',compact('treatment_record', 'centers', 'currentPatient', 'vaccines'));
       
         
    }

    public function destroy(TreatmentRecord $treatment_record,$id)
    {
        $treatment_record = TreatmentRecord::where('record_id',$id);
        $treatment_record->delete();
  
        return redirect('/home_treat')->with('success','Treatment Record deleted successfully');
    }

    public function reports()
    {
        $treatment_records =TreatmentRecord::paginate(10);
        $center_names = [];
        foreach ($treatment_records as $index=> $treat) {
            $center_id = $treat->center_id;
            $center_name = Center::where('center_id', $center_id)->value('center_name');
            $center_names[$index] = $center_name;
        }

        $vaccines = [];
        foreach ($treatment_records as $index=> $treat) {
            $vaccine_id = $treat->vaccine_id;
            $vaccine_name = Vaccine::where('vaccine_id', $vaccine_id)->value('vaccine');
            $vaccines[$index] = $vaccine_name;
        }
        $patients = [];
        $nin = [];
        foreach ($treatment_records as $index=> $treat) {
            $patient_id = $treat->patient_id;
            $patient_name = Patient::where('patient_id', $patient_id)->value('fullname');
            $ninp = Patient::where('patient_id', $patient_id)->value('nin');
            $patients[$index] = $patient_name;
            $nin [$index]= $ninp;
        }



        return view('report_treat',compact('treatment_records','center_names','patients','vaccines', 'nin'));
    }

    public function search(Request $request)
    {
    $search = $request->get('search');
    $treatment_records = DB::table('treatment_records')->where('record_id','like', '%'.$search.'%')
                                     ->orwhere('date','like','%'.$search.'%')
                
                                     ->paginate(10);
                                     $center_names = [];
                                     foreach ($treatment_records as $index=> $treat) {
                                        $center_id = $treat->center_id;
                                        $center_name = Center::where('center_id', $center_id)->value('center_name');
                                        $center_names[$index] = $center_name;
                                    }
                            
                                    $vaccines = [];
                                    foreach ($treatment_records as $index=> $treat) {
                                        $vaccine_id = $treat->vaccine_id;
                                        $vaccine_name = Vaccine::where('vaccine_id', $vaccine_id)->value('vaccine');
                                        $vaccines[$index] = $vaccine_name;
                                    }
                                    $patients = [];
                                    $nin = [];
                                    foreach ($treatment_records as $index=> $treat) {
                                        $patient_id = $treat->patient_id;
                                        $patient_name = Patient::where('patient_id', $patient_id)->value('fullname');
                                        $ninp = Patient::where('patient_id', $patient_id)->value('nin');
                                        $patients[$index] = $patient_name;
                                        $nin [$index]= $ninp;
                                    }
                             
                             
                             
                                     return view('report_treat',compact('treatment_records','center_names','patients','vaccines', 'nin'));
    }
}
