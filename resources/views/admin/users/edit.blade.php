@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-header">
            <h2>Editing {{  $user->display_name }}</h2>
        </div>

        <user-edit-component :user="{{ $user }}" :roles="{{ $roles }}"></user-edit-component>
    </div>
@endsection
