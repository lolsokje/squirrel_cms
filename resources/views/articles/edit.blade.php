@extends('layouts.admin')

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

            <title-component :article="{{ $article }}"></title-component>

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

            <div class="edit_buttons">
                <div class="edit_buttons_main">
                    <button type="submit" name="save_action" value="publish" class="btn btn-primary">Publish now</button>
                    <button type="submit" name="save_action" value="draft" class="btn btn-outline-primary">Save as draft</button>
                </div>
                @if ($article->status->name === 'deleted')
                    <button type="submit" name="save_action" value="perm_delete" class="btn btn-danger">Permanently delete</button>
                @endif
            </div>
        </form>
    </div>
@endsection
