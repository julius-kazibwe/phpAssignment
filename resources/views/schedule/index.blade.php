@extends('backend.lay')
@section('title', 'Center Schedule')
  
<link rel="stylesheet" href={{ url('css/product/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}>

<link rel="stylesheet" href={{ url('css/product/assets/css/style.css') }}>

@section('content')
    <div class="container">
        <h1>Schedule for {{ $center->center_name }}</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Add Schedule</h2>
                <form method="post" action="{{ route('schedule.store', $center->center_id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="time" class="form-control" name="start_time" required>
                    </div>
                    <div class="form-group">
                        <label for="end_time">End Time</label>
                        <input type="time" class="form-control" name="end_time" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url('/center') }}" class="btn btn-primary">Back</a>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Existing Schedules</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->date }}</td>
                                <td>{{ $schedule->start_time }}</td>
                                <td>{{ $schedule->end_time }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
