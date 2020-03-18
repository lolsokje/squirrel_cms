@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('categories') }}
        <div class="page-header">
            <h1>Categories</h1>
        </div>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">New category</a>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Articles</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->articles_count }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->name) }}" class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                                Edit
                            </a>
                            @if ($category->articles_count === 0)
                                <a href="#" class="btn btn-danger">
                                    <i class="fa fa-minus-circle"></i>
                                    Delete
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
