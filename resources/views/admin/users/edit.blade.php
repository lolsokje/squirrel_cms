@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('users.show', $user) }}
        <div class="page-header">
            <h1>Editing {{  $user->display_name }}</h1>
        </div>

        <user-edit-component :user="{{ $user }}" :roles="{{ $roles }}"></user-edit-component>
    </div>
@endsection
