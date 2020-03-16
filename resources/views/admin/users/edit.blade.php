@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('users.show', $user) }}
        <div class="page-header">
            <h2>Editing {{  $user->display_name }}</h2>
        </div>

        <form action="#">
            @csrf

            @foreach ($roles as $role)
                <div class="form-group">
                    <label for="{{ $role->id }}">{{ $role->name }}</label>
                    <input type="checkbox" id="{{ $role->id }}" {{ $user->hasRole($role) ? 'checked' : '' }}>
                </div>
            @endforeach
        </form>

{{--        <user-edit-component :user="{{ $user }}" :roles="{{ $roles }}"></user-edit-component>--}}
    </div>
@endsection
