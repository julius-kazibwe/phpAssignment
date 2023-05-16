@extends('backend.lay')
@section('title', 'Record Management')
  
<link rel="stylesheet" href={{ url('css/product/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}>

<link rel="stylesheet" href={{ url('css/product/assets/css/style.css') }}>

@section('content')
<div class="container">
    <div class="col-md-6">
   
        <legend>Vaccination Record</legend>
        Vaccination ID:<p>{{$treatment_record->record_id}}</p>
        Patient :<p>{{$patient_name}}</p>
        Center :<p>{{$center_name}}</p>
        NIN No:<p>{{$nin}}</p>
        Date:<p>{{$treatment_record->date}}</p>
        Vaccine:<p>{{$vaccine_name}}</p>

    </div>
    <a href="{{ url('/home_treat') }}" class="btn btn-primary">Back</a>
</div>

@endsection
