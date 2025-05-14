@extends('layouts.admin')

@section('title', 'Add Itinerary to Tours')

@section('content')
<div class="card shadow card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">Add Itinerary to a Tour</h3>
    </div>

    <div class="card-body">
        <div id="itineraryResponse" class="mb-3"></div>

        <form id="itineraryForm">
            @csrf
            <div class="form-group">
                <label for="tour">Select Tour</label>
                <select name="tour_id" id="tourSelect" class="form-control" required>
                    <option value="">-- Select Tour --</option>
                    @foreach($tours as $tour)
                        <option value="{{ $tour->id }}" data-days="{{ $tour->duration_days }}">
                            {{ $tour->title }} ({{ $tour->duration_days }} days)
                        </option>
                    @endforeach
                </select>

            </div>

            <hr>
            <div id="itineraryDayContainer"></div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-3">Save Itinerary</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('tourSelect').addEventListener('change', function () {
    const dayCount = this.options[this.selectedIndex].dataset.days;
    const container = document.getElementById('itineraryDayContainer');
    container.innerHTML = '';

    for (let day = 1; day <= dayCount; day++) {
        const daySection = document.createElement('div');
        daySection.classList.add('mb-4');
        daySection.innerHTML = `
            <h5 class="mb-2">Day ${day}</h5>
            <div class="itinerary-list" id="day-${day}-entries">
                ${getItineraryRow(day)}
            </div>
            <button type="button" class="btn btn-sm btn-secondary" onclick="addItinerary(${day})">+ Add Activity</button>
            <hr>
        `;
        container.appendChild(daySection);
    }
});

function getItineraryRow(day) {
    return `
    <div class="row itinerary-entry mb-2">
        <input type="hidden" name="day_number[]" value="${day}">
        <div class="col-md-2">
            <input type="text" name="time[]" class="form-control" placeholder="Time" required>
        </div>
        <div class="col-md-3">
            <input type="text" name="title[]" class="form-control" placeholder="Activity Title" required>
        </div>
        <div class="col-md-5">
            <input type="text" name="description[]" class="form-control" placeholder="Description">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.itinerary-entry').remove()">Remove</button>
        </div>
    </div>
    `;
}

function addItinerary(day) {
    const container = document.getElementById(`day-${day}-entries`);
    container.insertAdjacentHTML('beforeend', getItineraryRow(day));
}

document.getElementById('itineraryForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch(`{{ route('admin.itineraries.store') }}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const responseDiv = document.getElementById('itineraryResponse');
        if (data.success) {
            responseDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            form.reset();
            document.getElementById('itineraryDayContainer').innerHTML = '';
        } else {
            responseDiv.innerHTML = `<div class="alert alert-danger">${data.message || 'Something went wrong.'}</div>`;
        }
    })
    .catch(error => {
        console.error('Submission error:', error);
        document.getElementById('itineraryResponse').innerHTML = `<div class="alert alert-danger">Server error occurred.</div>`;
    });
});
</script>
@endpush
