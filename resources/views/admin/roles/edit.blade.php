@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('roles.show', $role) }}
        <div class="page-header">
            <h1>Edit role "{{ strtolower($role->name) }}"</h1>
        </div>

        <role-edit-component :role="{{ $role }}" :permissions="{{ $permissions }}"></role-edit-component>
    </div>
@endsection
