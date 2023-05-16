<?php  $styles=['css/main/login/login.css']; ?>

@extends('backend.lay')

@section('title', 'Record Manager')



@section('content')
<div class="container" id="app">
        <form action = "/searchtreat" method = "get" style="margin-left: 700px;">
            <div class = "input-group">
                <input type = "search" name = "search" placeholder="Search records" class="form-control">
                <span class = "input-group-prepend">
                    <button type="submit" class="btn btn-primary">Search</button>
                </span>
            </div>
        </form>
    {{-- pdf start --}}
    <div id="printContainer">
        <h1>Vaccination Record report</h1>
       


        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Center </th>
                    <th scope="col">Patient</th>
                    <th scope="col">NIN No</th>
                    <th scope="col">Date</th>
                    <th scope="col">Vaccine</th>
                </tr>
            </thead>
            <tbody>
                @if(count($treatment_records) > 0)
                        @foreach ($treatment_records as $index=> $treatment_record)
                         
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$center_names[$index]}}</td>
                                    <td>{{$patients[$index]}}</td>
                                    <td>{{$nin[$index]}}</td>
                                    <td>{{$treatment_record->date}}</td>
                                    <td>{{$vaccines[$index]}}</td>
                                <tr>
                           

                        @endforeach

                @else
                <p><i>No Records available, please add new one</i></p>
                @endif
            </tbody>
        </table>
    </div>
    {{-- pdf end --}}
    {{ $treatment_records->links() }}

    <a href="{{ url('/home_treat') }}" class="btn btn-primary">Back</a>

    <Button class="btn btn-primary" @click.preventDefault="print">Print Report</Button>
</div>
@endsection
