@extends('backend.lay')

@section('title', 'Record Management')
  
<link rel="stylesheet" href={{ url('css/product/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}>

    <link rel="stylesheet" href={{ url('css/product/assets/css/style.css') }}>

@section('content')

<div class="container">
    <div class="row">
      <div class="col-md-6">
      <form class="form-horizontal" method="POST" action="{{ url('/insert_prescription') }}" enctype="multipart/form-data">
       {{ csrf_field() }}
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
                <label>Patient_ID:</label>
                <input type="string" class="form-control" id="did" name="patient_id" placeholder="Enter Patient_id">
              </div>
   
           
           <div class="form-group">
             <label>Center_ID:</label>
             <input type="string" class="form-control" id="pid" name="center_id" placeholder="Enter Center_id">
           </div>

           <div class="form-group">
               <label>Vaccine_ID:</label>
               <input type="string" class="form-control" id="vaccine" name="vaccine" placeholder="Enter Vaccine_id">
           </div>

           <button type="submit" class="btn btn-primary">Submit</button>
           <button type="reset" class="btn btn-primary">Cancel</button>
           <a href="{{ url('/home_prescription') }}" class="btn btn-primary">Back</a>
         </fieldset>
       </form>
       <button type="button" onclick="myFunction()" class="btn-btn-primary">Demo</button>
       <script>
         function myFunction(){
         document.getElementById("did").value = "1";
         document.getElementById("pid").value = "1";
         document.getElementById("vaccine").value = "1";
         }

       </script>
      </div>
    </div>
  </div>

@endsection