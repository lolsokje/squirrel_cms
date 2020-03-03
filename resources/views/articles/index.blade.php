@extends('layouts.main')

@section('content')
    <div class="wide-container">
        <div class="page-header">
            <h1>Articles</h1>
        </div>

        <a class="btn btn-primary" href="{{ route('articles.create') }}">Publish new article</a>

        <article-component
            :articles="{{ json_encode($articles->items()) }}"
            :categories="{{ $categories }}"
            :editors="{{ $editors }}"
            :statuses="{{ $statuses }}"></article-component>

        @if ($articles->hasPages())
            <div id="pagination-container">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
@endsection
