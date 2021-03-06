@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('roles.create') }}
        <div class="page-header">
            <h1>Create new role</h1>
        </div>

        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

            <div class="form-group">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="form-group">
                <label for="name">Role name</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}">
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Permission</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" name="permissions[]" id="{{ $permission->id }}" value="{{ $permission->id }}">
                                <label for="{{ $permission->id }}">{{ $permission->name }}</label>
                            </td>
                            <td>{{ $permission->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
