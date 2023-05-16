
@extends('backend.l')
@section('title', 'Record Management')
  
<link rel="stylesheet" href={{ url('css/product/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}>

<link rel="stylesheet" href={{ url('css/product/assets/css/style.css') }}>

@section('content')
<div class="container">
    <div class="col-md-6">
        <legend>Prescription</legend>
        ID:<p>{{$prescription->id}}</p>
        Center:<p>{{$center}}</p>
        Patient:<p>{{$patient}}</p>
        Prescription:<p>{{$vaccine}}</p>

    </div>
    <a href="{{ '/home_prescription' }}" class="btn btn-primary">Back</a>
</div>

@endsection
