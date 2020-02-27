@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Manage Users</h1>

        <table>
            <thead>
            <tr>
                <th>Username</th>
                <th>Display Name</th>
                <th>Edit Articles</th>
                <th>Manage Website</th>
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
