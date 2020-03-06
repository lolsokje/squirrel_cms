@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>All information related to Squirrel TV</h1>
        </div>

        <div id="article-list">
            @foreach ($articles as $article)
                <h2>
                    <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                </h2>
                <small>Posted by {{ $article->user->display_name }}
                    <span title="{{ $article->created_at }}">
                        {{ $article->createdAtForHumans }}
                    </span>, last updated
                    <span title="{{ $article->updated_at }}">
                        {{ $article->updatedAtForHumans }}
                    </span>
                </small>
                <div class="article-content">
                    {!! $article->body !!}
                </div>
            @endforeach
        </div>

        @if ($articles->hasPages())
            <div id="pagination-container">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
@endsection
