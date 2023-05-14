<?php

namespace App\Http\Controllers;

use App\Center;
use App\Models\Vaccine;
use App\CenterController;
use Illuminate\Http\Request;

class CenterManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disabled ='';
        $centers = Center::all();
        $center_vaccines=[];
        foreach ($centers as $center) {
            $center_id = $center->center_id;
            $centre = Center::where('center_id', $center_id)->first();
            $vaccine_name = Vaccine::where('vaccine_id', $centre->vaccine_id)->value('vaccine');
            $center_vaccines[$center_id] = $vaccine_name;
        }
        //returns all center in the centers table.  
        return view('center.manage', compact('centers', 'disabled', 'center_vaccines'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //returns the view that creates a center.
        return view('center.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $center = new Center();
        $center->center_name = $request->center_name;
        $center->location = $request->location;
        $center->vaccine_id = $request->vaccine_id;
        try{
            $center->saveOrFail();
            return view('center.create',['success' => 'Entry added succesfully']);
        }catch(\Exception $excpetion){
            //try to categorize the error using the exception. 
            return view('center.create',['error' => 'An error occurred!']);
        }
       
        //return view('main.about');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function show(Center $center)
    {
        $contact_set = CenterContact::where('center_id','=', $center->center_id)->limit(2)->get();
        return view('center.view', ['center' => $center, 'contact_set' => $contact_set]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function edit(Center $center)
    {             
        $contact_set = CenterContact::where('doctor_id','=', $center->center_id)->limit(2)->get();       
       
        return view('center.edit', ['center' => $center, 'contact' => $contact_set]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Center $center)
    {        
        $center->update(
            [
                "center_name" => $request->center_name,
                "location" => $request->location,
                "vaccine_id" => $request->vaccine_id
            ]
        );

        //load telephone number 2 too.
        if(isset($request->telephone1)) {
            $contact = new DoctorContact();
            $contact->doctor_id = $center->doctor_id;

            //check whether the input number already exists in the table.            
            if(! CenterContact::where('contact_number', '=', $request->telephone1)->limit(1)->get()->count() )
            {
                $contact->contact_number = $request->telephone1;
                $contact->save();
            }       
                
        }

        if( isset($request->telephone2)){
            $contact = new CenterContact();
            $contact->doctor_id = $center->doctor_id;
            $contact->contact_number = $request->telephone2;
            $contact->save();
        }     

       // return view('center.edit', ['center' => $center, 'contact' => $contact]);   
       return redirect()->action(
        'CenterManagementController@edit', ['center' => $center->fresh()]
    );        

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function destroy(Center $center)
    {
    
    }

    public function searchCenter(Request $request){
        $search_query = $request->search_text;
        $list = Center::query()
            ->where("center_name", "LIKE", "%{$search_query}%")
                ->orWhere("location", 'LIKE', "%{$search_query}%")->get();
        return view('center.manage', ['centers'=> $list, 'disabled'=> 'disabled']);
    }
}
