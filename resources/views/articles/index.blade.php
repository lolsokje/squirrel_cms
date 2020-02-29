@extends('layouts.main')

@section('content')
    <div class="wide-container">
        <div class="page-header">
            <h1>Articles</h1>
        </div>

        <a class="btn btn-primary" href="{{ route('articles.create') }}">Publish new article</a>

        <div id="article-filter">
            <input type="text" placeholder="Filter by title or body content">

            <select name="category" id="category">
                <option value="">Filter by category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <select name="editor" id="editor">
                <option value="">Filter by editor</option>
                @foreach ($editors as $editor)
                    <option value="{{ $editor->id }}">{{ $editor->display_name }}</option>
                @endforeach
            </select>

            <select name="status" id="status">
                <option value="">Filter by status</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">{{ ucfirst($status->name) }}</option>
                @endforeach
            </select>
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
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>
                            <a href="{{ $article->url() }}">
                                {{ $article->title }}
                            </a>
                        </td>
                        <td>{{ $article->category->name }}</td>
                        <td>{{ $article->user->display_name }}</td>
                        <td>{{ $article->created_at->diffForHumans() }}</td>
                        <td>{{ $article->updated_at->diffForHumans() }}</td>
                        <td class="status">{{ ucfirst($article->status->name) }}</td>
                        <td>
                            <quick-action :article="{{ $article }}"></quick-action>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div id="pagination-container">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
