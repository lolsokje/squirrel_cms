@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Roles</h1>

            <table>
                <thead>
                    <tr>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('admin.role.edit', $role->name) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
