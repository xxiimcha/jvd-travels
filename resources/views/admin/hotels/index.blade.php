@extends('layouts.admin')
@section('title', 'All Hotels')

@section('content')
<div class="card shadow card-outline card-success">
    <div class="card-header">
        <h3 class="card-title">All Hotels</h3>
    </div>

    <div class="card-body table-responsive">
        @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Hotel Name</th>
                    <th>Location</th>
                    <th>Room Type</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th>Address</th>
                    <th>Image</th>
                    <th>Upload</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hotels as $index => $hotel)
                    <tr>
                        <td>{{ $hotel['id'] }}</td>
                        <td>{{ $hotel['hotel_name'] }}</td>
                        <td>{{ $hotel['location'] }}</td>
                        <td>{{ $hotel['room_type'] }}</td>
                        <td>{{ $hotel['duration'] }} night(s)</td>
                        <td>₱{{ number_format($hotel['price'], 2) }}</td>
                        <td>{{ $hotel['address'] }}</td>
                        <td>
                            @if ($localImages[$hotel['id']])
                                <img src="{{ $localImages[$hotel['id']] }}" alt="Hotel Image" width="80">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#uploadModal{{ $hotel['id'] }}">
                                Upload
                            </button>

                            <!-- Upload Modal -->
                            <div class="modal fade" id="uploadModal{{ $hotel['id'] }}" tabindex="-1" aria-labelledby="uploadModalLabel{{ $hotel['id'] }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.hotels.uploadImage', $hotel['id']) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="uploadModalLabel{{ $hotel['id'] }}">Upload Image for {{ $hotel['hotel_name'] }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="file" name="image" class="form-control" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Upload</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
