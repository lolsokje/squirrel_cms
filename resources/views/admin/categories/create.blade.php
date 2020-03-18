@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('categories.create') }}
        <div class="page-header">
            <h1>New category</h1>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
