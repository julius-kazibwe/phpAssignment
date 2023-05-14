@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">You have {{$appointments->count()}} appointment(s)</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Center</th>
                                <th scope="col">Time</th>
                                <th scope="col">Date for</th>
                                <th scope="col">Created date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as  $appointment)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$center_names[$appointment->center_id] }} </td>
                                <td>{{$appointment->time}}</td>
                                <td>{{$appointment->date}}</td>
                                <td>{{$appointment->created_at}}</td>
                                <td>
                                    @if($appointment->status==0)
                                    <button class="btn btn-primary">Not visited
                                    </button>
                                    @else
                                    <button class="btn btn-success">Checked
                                    </button>

                                    @endif
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6">You have no appointments</td>
                                </tr>
                            @endforelse
                            

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection