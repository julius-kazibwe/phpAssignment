<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use DB;

class FeedbackController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function fed()
    {
        return view('feedbackform.feed');
    }

    
    public function serv()
    {
        return view('AdminServ');
    }


   
    public function index()
    {
        $feedbacks = Feedback::orderBy('feedback_id','desc')->paginate(4);
        return view('Doctoradmin.adminfeed', compact('feedbacks'));
    }

    public function fedreport()
    {
        $feedbacks = Feedback::orderBy('feedback_id','desc')->paginate(8);
        return view('reports.feedbackreport', compact('feedbacks'));
    }

    public function fedadmin()
    {
        $feedbacks = Feedback::orderBy('feedback_id','desc')->paginate(3);
        return view('Doctoradmin.adminpage', compact('feedbacks'));
    }


   
    public function create()
    {
        return view('Doctoradmin.creategallery');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $feedback_data = DB::table('feedback')->where('patient_id','like', '%'.$search.'%')->paginate(50);
        return view('Doctoradmin.feedback_pdf', ['feedback_data' => $feedback_data]);
    }

    public function media()
    {
        return view('gallery');
    }

    public function admhome()
    {
        return view('Adhome');
    }

    
    public function store(Request $request)
    {
        $data=$this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);
        $feedback = new Feedback();
        $feedback->patient_id = auth()->user()->id;
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->message = $request->message;
        $feedback->save();


        
        return redirect('/feedback')->with('success','New Feedback Added');
    }

    

    public function edit($id)
    {
       
    }

   
    public function update(Request $request, $id)
    {

       
    }

   
    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete();
        return redirect('/adminfeedback')->with('success','Feedback Deleted');
    }
}
