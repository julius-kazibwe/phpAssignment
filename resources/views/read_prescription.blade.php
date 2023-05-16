
@extends('backend.l')
@section('title', 'Record Management')
  
<link rel="stylesheet" href={{ url('css/product/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}>

<link rel="stylesheet" href={{ url('css/product/assets/css/style.css') }}>

@section('content')

<div class="container">
        <h1>Prescription</h1>
    
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Vaccination Center</th>
                    <th scope="col">Patient</th>
                    <th scope="col">Vaccine</th>
                </tr>
            </thead>
            <tbody>
                @if(count($prescription) > 0)
                        @foreach ($prescription as $index => $p)
                         
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$centers[$index]}}</td>
                                        <td>{{$currentPatient->fullname}}</td>
                                        <td>{{$vaccines[$index]}}</td>
                                    <tr>
                           

                        @endforeach

                @else
                <p><i>No Prescriptions available</i></p>
                @endif
            </tbody>
        </table>
    </div>    

    <a href="{{ '/patient' }}" class="btn btn-primary">Back</a>
</div>

@endsection
