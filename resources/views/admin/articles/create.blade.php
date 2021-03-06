@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('articles.new') }}

        <div class="page-header">
            <h1>Publish new article</h1>
        </div>
        <form action="{{ route('articles.store') }}" method="POST">
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

            <title-component></title-component>

            <div class="form-group">
                <label for="body">Body</label>
                <wysiwyg></wysiwyg>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" name="save_action" value="publish" class="btn btn-primary">Publish now</button>
            <button type="submit" name="save_action" value="draft" class="btn btn-outline-primary">Save as draft</button>
        </form>
    </div>
@endsection
