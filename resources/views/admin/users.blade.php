@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('users') }}
        <div class="page-header">
            <h1>Manage Users</h1>
        </div>

        <table class="table-center-text">
            <thead>
            <tr>
                <th>Username</th>
                <th>Display Name</th>
                <th>Roles</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                @include('admin.user')
            @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
@endsection
