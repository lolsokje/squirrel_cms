@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>All information related to Squirrel TV</h1>
        </div>
        @foreach ($articles as $article)
            <h2>{{ $article->title }}</h2>
            {!! $article->body !!}
        @endforeach
    </div>
@endsection
