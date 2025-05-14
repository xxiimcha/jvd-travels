@extends('layouts.admin')

@section('title', 'Transportation Rating & Schedule')

@section('content')
<div class="card shadow card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Rating & Schedule</h3>
        <a href="#" class="btn btn-sm btn-primary">
            <i class="fas fa-plus-circle"></i> Add Transport Schedule
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Transport Name</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                        <th>Route</th>
                        <th>Rating</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1; @endphp
                    @forelse ($schedules as $schedule)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $schedule['company'] }}</td>
                        <td>--</td> {{-- No departure time in API --}}
                        <td>--</td> {{-- No arrival time in API --}}
                        <td>{{ $schedule['destination_type'] }} - {{ $schedule['destination'] }}</td>
                        <td>
                            {{-- Simulated static rating based on price or estimated_time --}}
                            @php $rating = min(5, ceil($schedule['estimated_time'] / 2)); @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $rating ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No transportation data available.</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
