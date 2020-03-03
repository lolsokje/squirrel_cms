@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Publish new article</h1>
        </div>
        <form action="{{ route('articles.update', $article) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $article->title }}" required>
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <wysiwyg :article="{{ $article }}"></wysiwyg>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id === $article->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" name="save_action" value="publish" class="btn btn-primary">Publish now</button>
            <button type="submit" name="save_action" value="draft" class="btn btn-outline-primary">Save as draft</button>
        </form>
    </div>
@endsection
