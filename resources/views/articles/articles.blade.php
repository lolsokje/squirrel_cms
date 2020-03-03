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
