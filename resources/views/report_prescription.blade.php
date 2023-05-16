<?php  $styles=['css/main/login/login.css']; ?>

@extends('backend.lay')

@section('title', 'Record Manager')



@section('content')
<div class="container" id="app">
        <form action = "/searchpre" method = "get" style="margin-left: 700px;">
            <div class = "input-group">
                <input type = "search" name = "search" placeholder="Search records" class="form-control">
                <span class = "input-group-prepend">
                    <button type="submit" class="btn btn-primary">Search</button>
                </span>
            </div>
        </form>
    {{-- pdf start --}}
    <div id="printContainer">
        <h1>Prescription report</h1>
       


        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Center</th>
                    <th scope="col">Patient</th>
                    <th scope="col">vaccine</th>
                </tr>
            </thead>
            <tbody>
                @if(count($prescriptions) > 0)
                        @foreach ($prescriptions as $index=> $prescription)
                         
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$centers[$index]}}</td>
                                        <td>{{$patients[$index]}}</td>
                                        <td>{{$vaccines[$index]}}</td>
                                    <tr>
                           

                        @endforeach

                @else
                <p><i>No Prescriptions available, please add new one</i></p>
                @endif
            </tbody>
        </table>
    </div>
    {{-- pdf end --}}
    {{ $prescriptions->links() }}

    <a href="{{ url('/home_prescription') }}" class="btn btn-primary">Back</a>

    <Button class="btn btn-primary" @click.preventDefault="print">Print Report</Button>
</div>
@endsection
