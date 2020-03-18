@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('categories.edit', $category) }}
        <div class="page-header">
            <h1>Edit category '{{ strtolower($category->name) }}'</h1>
        </div>

        <form action="{{ route('admin.categories.update', $category->name) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
