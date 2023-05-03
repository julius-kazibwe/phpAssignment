@extends('backend.lay')
@section('title', 'Record Management')
  
<link rel="stylesheet" href={{ url('css/product/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}>

<link rel="stylesheet" href={{ url('css/product/assets/css/style.css') }}>

@section('content')
<div class="container">
    <div class="col-md-6">
        <legend>Treatment Record</legend>
        ID:<p>{{$treatment_record->record_id}}</p>
        Patient ID:<p>{{$treatment_record->patient_id}}</p>
        Doctor ID:<p>{{$treatment_record->doctor_id}}</p>
        Full Name:<p>{{$treatment_record->name}}</p>
        NIC No:<p>{{$treatment_record->nic}}</p>
        Date:<p>{{$treatment_record->date}}</p>
        Description:<p>{{$treatment_record->description}}</p>

    </div>
    <a href="{{ url('/home_treat') }}" class="btn btn-primary">Back</a>
</div>

@endsection
