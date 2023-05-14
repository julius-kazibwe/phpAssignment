@extends('backend.lay')

@section('title', 'Record Management')
  
<link rel="stylesheet" href={{ url('css/product/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}>
<link rel="stylesheet" href={{ url('css/product/assets/css/style.css') }}>

@section('content')

<div class="container">
    <div class="row">
      <div class="col-md-6">
      <form class="form-horizontal" method="GET" action="{{ url('/home_treat') }}" enctype="multipart/form-data">
       {{ csrf_field() }}
       @method('PUT')
         <fieldset>
           <legend>Treatment Record</legend>
            @if (count($errors)>0)
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">
                      {{ $error }}
                  </div>    
                @endforeach
            @endif
           
          <div class="form-group">
                <label>Center_ID:</label>
                <input type="string" class="form-control" id="did" name="center_id" value="{{$treatment_record->center_id}}" required>
              </div>
   
           
           <div class="form-group">
             <label>Patient_ID:</label>
             <input type="string" class="form-control" id="pid" name="patient_id" value="{{$treatment_record->patient_id}}" required>
           </div>
            
           <div class="form-group">
             <label>Full Name</label>
             <input type="string" class="form-control" id="fname" name="fullname" value="{{$treatment_record->fullname}}" required>
           </div>

           <div class="form-group">
             <label>NIN NO</label>
             <input type="string" class="form-control" id="nin" name="nin" value="{{$treatment_record->nin}}" required>
           </div>

            <div class="form-group">
             Date:<input type="date" class="form-control-file" name="date" value="{{$treatment_record->date}}" required>
           </div>

           <div class="form-group">
            <label>Note on patient:</label>
            <textarea class="form-control" id="vaccine" name="vaccine" rows="3" >{{$treatment_record->vaccine}}</textarea>
           </div>

           <button type="update" class="btn btn-primary">Update</button>
           <button type="reset" class="btn btn-primary">Cancel</button>
           <a href="{{ url('/home_treat') }}" class="btn btn-primary">Back</a>
         </fieldset>
       </form>
      </div>
    </div>
  </div>

@endsection