@extends('backend.lay')

@section('title', 'Record Management')
  
<link rel="stylesheet" href={{ url('css/product/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}>
<link rel="stylesheet" href={{ url('css/product/assets/css/style.css') }}>

@section('content')

<div class="container">
    <div class="row">
      <div class="col-md-6">
      <form class="form-horizontal" method="GET" action="{{route('edit1', ['record_id' => $treatment_record->record_id]) }} ">
       {{ csrf_field() }}
       @method('PUT')
         <fieldset>
           <legend>Update Vaccination Record</legend>
            @if (count($errors)>0)
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">
                      {{ $error }}
                  </div>    
                @endforeach
            @endif
           
          <div class="form-group">
                <label>Center_ID:</label>
                <input type="string" class="form-control" id="did" name="center_id" value="{{$treatment_record->center_id}}" >
              </div>
   
           
           <div class="form-group">
             <label>Patient_ID:</label>
             <input type="string" class="form-control" id="pid" name="patient_id" value="{{$treatment_record->patient_id}}" >
           </div>
            

            <div class="form-group">
             Date:<input type="date" class="form-control-file" name="date" value="{{$treatment_record->date}}">
           </div>

           <div class="form-group">
            <label>Vaccine taken:</label>
            <input type= "string" class="form-control" id="vaccine" name="vaccine"  value="{{$treatment_record->vaccine_id}}" >
           </div>

           
           <button type="submit" class="btn btn-primary">Update</button>
           <button type="reset" class="btn btn-primary">Cancel</button>
           <a href="{{ url('/home_treat') }}" class="btn btn-primary">Back</a>
         </fieldset>
       </form>
      </div>
    </div>
  </div>

@endsection