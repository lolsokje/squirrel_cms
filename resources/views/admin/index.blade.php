@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('home') }}

        <h2>Welcome, {{ Auth::user()->display_name }}</h2>
    </div>
@endsection
