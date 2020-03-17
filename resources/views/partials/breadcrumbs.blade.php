<link rel="stylesheet" href="{{ asset('css/breadcrumbs.css') }}">

@if (count($breadcrumbs))
    <div id="breadcrumbs">
        <ul>
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li><a class="breadcrumb-item" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="active"><a href="#">{{ $breadcrumb->title }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
