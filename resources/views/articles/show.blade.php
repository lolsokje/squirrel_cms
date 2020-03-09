@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{ $article->title }}</h1>
            <small>by {{ $article->user->display_name }} {{ $article->createdAtForHumans }},
                last updated {{ $article->updatedAtForHumans }}
            </small>
        </div>

        <div id="article-list">
            <div class="article">
                <div class="article-content">
                    {!! $article->body !!}
                </div>
            </div>

            @can('edit articles')
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-primary">Edit article</a>
            @endcan
        </div>
    </div>
@endsection
