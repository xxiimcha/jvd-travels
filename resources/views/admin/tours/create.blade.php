@extends('layouts.admin')

@section('title', 'Create Tour Schedule')

@section('content')
<div class="card shadow card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Create New Tour Schedules</h3>
    </div>

    <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label>Select Tour From API</label>
                <select name="api_tour_id" id="apiTourSelect" class="form-control" required>
                    <option value="">-- Select a Tour --</option>
                </select>
            </div>

            <div id="tourDetails" style="display: none;">
                <input type="hidden" name="title" id="title">
                <input type="hidden" name="tour_type" id="tour_type">
                <input type="hidden" name="duration_days" id="duration_days">
                <input type="hidden" name="duration_nights" id="duration_nights">
                <input type="hidden" name="price" id="price">
                <input type="hidden" name="capacity" id="capacity">

                <div class="form-group">
                    <label>Optional Description</label>
                    <textarea name="description" id="descriptionEditor" class="form-control" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label>Brochure Image (optional)</label>
                    <input type="file" name="brochure" class="form-control-file" onchange="previewBrochure(event)">
                    <div class="mt-2">
                        <img id="brochurePreview" src="#" alt="Brochure Preview" style="display:none; max-width:200px;">
                    </div>
                </div>

                <hr>
                <h5>Tour Schedules</h5>
                <div id="scheduleContainer">
                    <div class="row mb-2 schedule-row">
                        <div class="col-md-10">
                            <input type="date" name="schedules[]" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-sm remove-schedule">Remove</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary btn-sm" id="addScheduleBtn">+ Add Another Schedule</button>
            </div>
        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Tour Schedules</button>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('descriptionEditor');

function previewBrochure(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('brochurePreview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}

document.addEventListener('DOMContentLoaded', function () {
    fetch('https://core2.easetravelandtours.com/api/fetch-tour')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const select = document.getElementById('apiTourSelect');
                data.data.forEach(tour => {
                    const option = document.createElement('option');
                    option.value = tour.id;
                    option.dataset.tour = JSON.stringify(tour);
                    option.text = `${tour.location} - ₱${tour.price} (${tour.duration_days}D/${tour.duration_nights}N) - ${tour.date}`;
                    select.appendChild(option);
                });
            }
        });

    document.getElementById('apiTourSelect').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        if (!selected.value) {
            document.getElementById('tourDetails').style.display = 'none';
            return;
        }

        const tour = JSON.parse(selected.dataset.tour);
        document.getElementById('tourDetails').style.display = 'block';
        document.getElementById('title').value = tour.location + ' Tour';
        document.getElementById('tour_type').value = tour.tour_type;
        document.getElementById('duration_days').value = tour.duration_days;
        document.getElementById('duration_nights').value = tour.duration_nights;
        document.getElementById('price').value = tour.price;
        document.getElementById('capacity').value = tour.pax;
    });

    document.getElementById('addScheduleBtn').addEventListener('click', function () {
        const container = document.getElementById('scheduleContainer');
        const row = document.createElement('div');
        row.classList.add('row', 'mb-2', 'schedule-row');
        row.innerHTML = `
            <div class="col-md-10">
                <input type="date" name="schedules[]" class="form-control" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-schedule">Remove</button>
            </div>
        `;
        container.appendChild(row);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-schedule')) {
            e.target.closest('.schedule-row').remove();
        }
    });
});
</script>
@endsection
