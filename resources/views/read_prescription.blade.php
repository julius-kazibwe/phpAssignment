
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
                    <th scope="col">ID</th>
                    <th scope="col">Center-ID</th>
                    <th scope="col">Patient-ID</th>
                    <th scope="col">Vaccine</th>
                </tr>
            </thead>
            <tbody>
                @if(count($prescription) > 0)
                        @foreach ($prescription as $p)
                         
                                    <tr>
                                        <td>{{$p->id}}</td>
                                        <td>{{$p->center_id}}</td>
                                        <td>{{$p->patient_id}}</td>
                                        <td>{{$p->vaccine}}</td>
                                    <tr>
                           

                        @endforeach

                @else
                <p><i>No Prescriptions available, please add new one</i></p>
                @endif
            </tbody>
        </table>
    </div>    

    <a href="{{ '/patient' }}" class="btn btn-primary">Back</a>
</div>

@endsection
