@extends('layouts.admin')

@section('title', 'Customer Accounts')

@section('content')
<div class="card shadow card-primary card-outline">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Customer Accounts</h3>
    </div>

    <div class="card-body table-responsive">
        @if($users->isEmpty())
            <div class="alert alert-info">No customer accounts found.</div>
        @else
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->contact ?? 'N/A' }}</td>
                    <td>{{ $user->created_at->format('F j, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
