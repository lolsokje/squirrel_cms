<div id="nav">
    <div class="container nav-bar">
        <div id="left">
            <ul>
                <li class="list-item"><a href="{{ route('index') }}">Home</a></li>
                @auth
{{--                    <li class="list-item">{{ auth()->user()->display_name }}</li>--}}
                    @can('edit articles')
                        <li class="list-item"><a href="{{ route('articles.index') }}">Articles</a></li>
                    @endcan
                    @can('manage')
                        <li class="list-item"><a href="{{ route('admin.index') }}">Admin Panel</a></li>
                    @endcan
                @endauth
            </ul>
        </div>

        <div id="right">
            <ul>
                @auth
                    <li class="list-item"><a href="{{ route('logout') }}">Logout</a></li>
                @endauth
            </ul>
        </div>
    </div>
</div>
