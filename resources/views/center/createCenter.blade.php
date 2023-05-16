@extends('backend.l')
@section('title', 'Add A New Center')
  
<link rel="stylesheet" href={{ url('css/product/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}>

<link rel="stylesheet" href={{ url('css/product/assets/css/style.css') }}>


@section('content')

<div class="container">
    <div class="row">
      <div class="col-md-6">
      <form class="form-horizontal" method="POST" action="{{ url('/insert_center') }}" enctype="multipart/form-data">
       {{ csrf_field() }}
       
         <fieldset>
           <legend>Insert New Center Records</legend>
            @if (count($errors)>0)
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">
                      {{ $error }}
                  </div>    
                @endforeach
            @endif
            <div class="form-group">
                <label>Center Name:</label>
                <input type="string" class="form-control" name="center_name" placeholder="Enter center_name">
              </div>
   
           
           <div class="form-group">
             <label>Location:</label>
             <input type="string" class="form-control" name="location" placeholder="Enter center_location">
           </div>


           <div class="form-group">
            <label>Vaccine Available:</label>
            <input type="string" class="form-control"  name="vaccine_id" placeholder="Enter vaccine_id">
           </div>

           <button type="submit" class="btn btn-primary">Submit</button>
           <a href="{{ url('/center') }}" class="btn btn-primary">Back</a>
         </fieldset>
       </form>
       
      </div>
    </div>
  </div>

@endsection