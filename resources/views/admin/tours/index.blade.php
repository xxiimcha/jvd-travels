@extends('layouts.admin')

@section('title', 'All Tours')

@section('content')
<div class="card shadow card-primary card-outline">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">All Tours</h3>
        <a href="{{ route('admin.tours.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus-circle"></i> Add New Tour
        </a>
    </div>

    <div class="card-body table-responsive">
        @if($tours->isEmpty())
            <div class="alert alert-info">No tours found.</div>
        @else
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Tour Type</th>
                    <th>Duration</th>
                    <th>Price (₱)</th>
                    <th>Capacity</th>
                    <th>Schedules</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tours as $index => $group)
                @php
                    $first = $group->first();
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $first->title }}</td>
                    <td>{{ $first->tour_type }}</td>
                    <td>{{ $first->duration_days }}D/{{ $first->duration_nights }}N</td>
                    <td>₱{{ number_format($first->price, 2) }}</td>
                    <td>{{ $first->capacity }}</td>
                    <td>
                        <ul class="mb-0">
                            @foreach ($group as $schedule)
                                <li>{{ \Carbon\Carbon::parse($schedule->schedule_date)->format('F j, Y') }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('admin.tours.show', $first->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this tour schedule group?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
