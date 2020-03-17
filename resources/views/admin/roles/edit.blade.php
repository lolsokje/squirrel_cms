@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Edit role "{{ strtolower($role->name) }}"</h1>

            <role-edit-component :role="{{ $role }}" :permissions="{{ $permissions }}"></role-edit-component>

{{--            <table style="width:50%;margin: 30px 0">--}}
{{--                <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Permission</th>--}}
{{--                        <th></th>--}}
{{--                    </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                    @foreach ($permissions as $permission)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $permission->name }}</td>--}}
{{--                            <td>--}}
{{--                                <input type="checkbox" {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}

{{--            <button class="btn btn-primary">Update role</button>--}}
        </div>
    </div>
@endsection
