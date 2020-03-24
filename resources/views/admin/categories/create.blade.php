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
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
