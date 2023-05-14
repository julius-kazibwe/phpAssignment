@extends('backend.lay')

@section('title', 'Record Management')
  
<link rel="stylesheet" href={{ url('css/product/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}>

    <link rel="stylesheet" href={{ url('css/product/assets/css/style.css') }}>

@section('content')

<div class="container">
    <div class="row">
      <div class="col-md-6">
      <form class="form-horizontal" method="POST" action='{{ url("/update_prescription/{$prescription->id}") }}'>
     
      @csrf
      @method('PUT')
      <input type= 'hidden' value="{{$prescription->id}}" id="id">


      
         <fieldset>
           <legend>Prescription</legend>
            @if (count($errors)>0)
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">
                      {{ $error }}
                  </div>    
                @endforeach
            @endif
          
            <div class="form-group">
                <label>Center_ID:</label>
                <input type="string" class="form-control" id="pid" name="doctor_id" placeholder="Enter Doctor_id" value="{{$prescription->center_id}}">
              </div>
   
           
           <div class="form-group">
             <label>Patient_ID:</label>
             <input type="string" class="form-control" id="pid" name="patient_id" placeholder="Enter Patient_id" value="{{$prescription->patient_id}}">
           </div>

           <div class="form-group">
               <label>Prescription:</label>
               <textarea class="form-control" id="Description" name="description" rows="3">{{$prescription->vaccine}}</textarea>
           </div>
           <button type="submit" class="btn btn-primary">Update</button>
           <button type="reset" class="btn btn-primary">Cancel</button>
           <a href="{{ url('/home_prescription') }}" class="btn btn-primary">Back</a>
         </fieldset>
       </form>
      </div>
    </div>
  </div>

@endsection