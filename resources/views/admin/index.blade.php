@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Admin Panel</h1>

        <div id="admin-panel-wrapper">
            <a href="{{ route('admin.users') }}" class="admin-panel-item">
                <h3>Manage Users</h3>

                <p>Total users: {{ $userCount }}</p>
            </a>
        </div>
    </div>
@endsection
