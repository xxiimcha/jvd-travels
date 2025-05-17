@extends('layouts.admin')

@section('title', 'Transportation Rating')

@section('content')
<div class="card shadow card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Transportation Rating</h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Transport Name</th>
                        <th>Owner/Company</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1; @endphp

                    @forelse ($schedules['data'] ?? [] as $schedule)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $schedule['model'] ?? 'N/A' }} <small>({{ $schedule['manufacturer'] ?? '' }})</small></td>
                        <td>{{ $schedule['owner_name'] ?? 'N/A' }}</td>
                        <td>
                            ₱ {{ isset($schedule['purchase_price']) ? number_format($schedule['purchase_price'], 2) : 'N/A' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No vehicle data available.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
