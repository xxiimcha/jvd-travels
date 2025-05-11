@extends('layouts.admin')

@section('title', 'Create Tour')

@section('content')
<div class="card shadow card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Create New Tour</h3>
    </div>

    <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Tour Title</label>
                <input type="text" name="title" class="form-control" required placeholder="Enter tour title">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="descriptionEditor" class="form-control" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label>Duration (in days)</label>
                <input type="number" name="duration" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Price (₱)</label>
                <input type="number" name="price" step="0.01" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Seasonal Availability</label>
                <select name="season" class="form-control">
                    <option value="Any">Any</option>
                    <option value="Summer">Summer</option>
                    <option value="Rainy">Rainy</option>
                    <option value="Holiday">Holiday</option>
                </select>
            </div>

            <div class="form-group">
                <label>Max Capacity</label>
                <input type="number" name="capacity" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Brochure Image (optional)</label>
                <input type="file" name="brochure" class="form-control-file">
            </div>
        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Tour</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('descriptionEditor');
</script>
@endsection
