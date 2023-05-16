@extends('backend.lay')

@section('title', 'Record Management')
  
<link rel="stylesheet" href={{ url('css/product/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}>

    <link rel="stylesheet" href={{ url('css/product/assets/css/style.css') }}>

@section('content')

<div class="container">
    <div class="row">
      <div class="col-md-6">
      <form class="form-horizontal" method="POST" action="{{route('edit2',  ['id' => $prescription->id])}}">
     
      @csrf
      @method('PUT')


         <fieldset>
           <legend>Update Patient Prescription</legend>
            @if (count($errors)>0)
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">
                      {{ $error }}
                  </div>    
                @endforeach
            @endif
          
            <div class="form-group">
                <label>Center_ID:</label>
                <input type="string" class="form-control"  name="center_id"  value="{{$prescription->center_id}}">
              </div>
   
           
           <div class="form-group">
             <label>Patient_ID:</label>
             <input type="string" class="form-control"  name="patient_id" value="{{$prescription->patient_id}}">
           </div>

           <div class="form-group">
               <label>Vaccine_ID:</label>
               <input type = "string" class="form-control"  name="vaccine" value ="{{$prescription->vaccine}}">
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