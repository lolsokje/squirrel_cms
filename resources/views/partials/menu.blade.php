<div id="nav">
    <div class="container nav-bar">
        <div id="left">
            <ul>
                <li class="list-item"><a href="{{ route('index') }}">Home</a></li>
                @auth
                    @can('manage')
                        <li class="list-item"><a href="{{ route('admin.index') }}">Admin Panel</a></li>
                    @elsecan('edit articles')
                        <li class="list-item"><a href="{{ route('articles.index') }}">Manage Articles</a></li>
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
