@extends('layouts.admin')

@section('title', 'All Hotels')

@section('content')
<div class="card shadow card-outline card-success">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Hotel Listings</h3>
        <a href="{{ route('admin.hotels.create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus-circle"></i> Add Hotel
        </a>
    </div>

    <div class="card-body table-responsive">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-hover align-middle">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Hotel Name</th>
                    <th>Location</th>
                    <th>Room Types & Prices</th>
                    <th>Address</th>
                    <th>Image</th>
                    <th>Upload</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hotels as $index => $hotel)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $hotel->hotel_name }}</td>
                    <td>{{ $hotel->location }}</td>
                    <td>
                        @php
                            $roomTypes = json_decode($hotel->room_type_pricing, true);
                        @endphp

                        @if (is_array($roomTypes))
                            <ul class="mb-0 ps-3">
                                @foreach ($roomTypes as $room)
                                    <li>
                                        <strong>{{ $room['type'] }}</strong> – ₱{{ number_format($room['price'], 2) }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">No room types</span>
                        @endif
                    </td>
                    <td>{{ $hotel->address }}</td>
                    <td>
                        @if (!empty($localImages[$hotel->id]))
                            <img src="{{ $localImages[$hotel->id] }}" alt="Hotel Image" class="img-thumbnail" style="width: 80px; height: auto;">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal{{ $hotel->id }}">
                            <i class="fas fa-upload"></i>
                        </button>

                        <!-- Upload Modal -->
                        <div class="modal fade" id="uploadModal{{ $hotel->id }}" tabindex="-1" aria-labelledby="uploadModalLabel{{ $hotel->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('admin.hotels.uploadImage', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="uploadModalLabel{{ $hotel->id }}">Upload Image - {{ $hotel->hotel_name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="file" name="image" class="form-control" accept="image/*" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Upload</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No hotels found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
