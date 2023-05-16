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
        
        $centers = Center::all();
        $center_vaccines=[];
        foreach ($centers as $index=>$center) {
            $center_id = $center->center_id;
            $centre = Center::where('center_id', $center_id)->first();
            $vaccine_name = Vaccine::where('vaccine_id', $centre->vaccine_id)->value('vaccine');
            $center_vaccines[$index] = $vaccine_name;
        }
        //returns all center in the centers table.  
        return view('center.manage', compact('centers', 'center_vaccines'));
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
        $request->validate([
            'center_name'=>'required',
            'location' => 'required',
            'vaccine_id' => 'required'
        ]);

        $center = new Center();
        $center->center_name = $request->center_name;
        $center->location = $request->location;
        $center->vaccine_id = $request->vaccine_id;
        try{
            $center->saveOrFail();
            return redirect('/center')->with('info','A new Center has been added successfully!');
        }catch(Exception $excpetion){
            return view('center.createCenter',['error' => 'An error occurred!']);
        }
       
       
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
                $centers = $list;
                $center_vaccines=[];
            foreach ($centers as $index=>$center) {
            $center_id = $center->center_id;
            $centre = Center::where('center_id', $center_id)->first();
            $vaccine_name = Vaccine::where('vaccine_id', $centre->vaccine_id)->value('vaccine');
            $center_vaccines[$index] = $vaccine_name;
        }
        
        return view('center.manage', compact('centers', 'center_vaccines'));
    }
}
