@extends('layouts.admin')

@section('title', 'Add New Hotel')

@section('content')
<div class="card shadow card-outline card-success">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Add New Hotel</h3>
        <a href="{{ route('admin.hotels.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Please fix the following errors:
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="hotel_name" class="form-label">Hotel Name</label>
                <input type="text" name="hotel_name" class="form-control" value="{{ old('hotel_name') }}" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Room Types & Prices</label>
                <div id="roomTypeContainer">
                    <div class="row g-2 mb-2 room-row">
                        <div class="col-md-6">
                            <input type="text" name="room_types[]" class="form-control" placeholder="Room Type (e.g. Deluxe)" required>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="room_prices[]" class="form-control" placeholder="Price per Day" step="0.01" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger w-100 remove-room">Remove</button>
                        </div>
                    </div>
                </div>
                <button type="button" id="addRoomType" class="btn btn-sm btn-outline-primary mt-1">+ Add Room Type</button>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Full Address</label>
                <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Hotel Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Save Hotel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('addRoomType').addEventListener('click', function () {
        const container = document.getElementById('roomTypeContainer');
        const row = document.createElement('div');
        row.classList.add('row', 'g-2', 'mb-2', 'room-row');
        row.innerHTML = `
            <div class="col-md-6">
                <input type="text" name="room_types[]" class="form-control" placeholder="Room Type (e.g. Standard)" required>
            </div>
            <div class="col-md-4">
                <input type="number" name="room_prices[]" class="form-control" placeholder="Price per Day" step="0.01" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger w-100 remove-room">Remove</button>
            </div>
        `;
        container.appendChild(row);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-room')) {
            e.target.closest('.room-row').remove();
        }
    });
</script>
@endsection
