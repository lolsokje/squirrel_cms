@extends('layouts.admin')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('articles') }}
        <div class="page-header">
            <h1>Articles</h1>
        </div>

        <a class="btn btn-primary" href="{{ route('articles.create') }}">Publish new article</a>

        @if (count($articles->items()))
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
        @else
            <p style="margin-top: 30px;">No articles found</p>
        @endif
    </div>
@endsection
