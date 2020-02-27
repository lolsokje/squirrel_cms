@extends('layouts.main')

@section('content')
    <div class="wide-container">
        <div class="page-header">
            <h1>Articles</h1>
        </div>

        <a class="btn btn-primary" href="{{ route('articles.create') }}">Publish new article</a>

        <table>
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
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->category->name }}</td>
                        <td>{{ $article->user->display_name }}</td>
                        <td>{{ $article->created_at->diffForHumans() }}</td>
                        <td>{{ $article->updated_at->diffForHumans() }}</td>
                        <td>Published</td>
                        <td>
                            <quick-edit :article="{{ $article }}"></quick-edit>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
