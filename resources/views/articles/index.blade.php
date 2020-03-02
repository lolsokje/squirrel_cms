@extends('layouts.main')

@section('content')
    <div class="wide-container">
        <div class="page-header">
            <h1>Articles</h1>
        </div>

        <a class="btn btn-primary" href="{{ route('articles.create') }}">Publish new article</a>

        <div id="article-filter">
            <input type="text" id="text" name="text" placeholder="Filter by title or body content" class="article-filter">

            <div id="selects">
                <select class="styled-select article-filter" name="category" id="category">
                    <option value="">Filter by category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <select class="styled-select article-filter" name="editor" id="editor">
                    <option value="">Filter by editor</option>
                    @foreach ($editors as $editor)
                        <option value="{{ $editor->twitch_id }}">{{ $editor->display_name }}</option>
                    @endforeach
                </select>

                <select class="styled-select article-filter" name="status" id="status">
                    <option value="">Filter by status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ ucfirst($status->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <table class="table-border">
            <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Created</th>
                <th>Last edited</th>
                <th>Status</th>
                <th>Quick Actions</th>
            </tr>
            </thead>
            <tbody id="articles">
                @include('articles.articles')
            </tbody>
        </table>

        @if ($articles->hasPages())
            <div id="pagination-container">
                {{ $articles->appends(request()->input())->links() }}
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/article_filter.js') }}"></script>
@endsection
